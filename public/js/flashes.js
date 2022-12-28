setTimeout(function () {

    const alerts = document.getElementsByClassName('alert');
    for (let i = 0; i < alerts.length; i++) {

        alerts[i].remove();

    }

}, 3000);