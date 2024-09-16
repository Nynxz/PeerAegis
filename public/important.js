window.onload = function() {
    fetch('http://localhost:8000/ping', {
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
