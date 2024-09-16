window.onload = function() {
    fetch('https://ping.nynxz.com/', {
        method: 'GET',
    })
    .then(response => {
        if (response.ok) {
        } else {
            console.error('Dont steal my stuff :)');
        }
        console.log('Website designed by Henry Lee @ 2024!\nContact: henry.lee@griffithuni.edu.au');
    })
}
