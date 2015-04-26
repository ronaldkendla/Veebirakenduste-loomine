 function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      sisselogitud();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('plakatid').innerHTML = 'Kasutamiseks pead olema sisse logitud. ';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('plakatid').innerHTML = 'Kasutamiseks pead olema sisse logitud. ';
    }
  }

    function sisselogitud() {
        FB.api('/me', function (response) {
            if (document.getElementById('plakatid').innerHTML == 'Kasutamiseks pead olema sisse logitud. ') {
                document.location.reload();
            }
            document.getElementById('login').innerHTML =
        'Oled sisenenud kui ' + response.name + '.     ';
            document.kandideerimisform.eesnimi.value = response.first_name;
            document.kandideerimisform.perenimi.value = response.last_name;
            document.getElementById('logout').innerHTML =
        'Logi välja!';
        });
  }