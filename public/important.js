window.onload = function() {
    // Capture the current time
    const accessTime = new Date().toISOString();

    // Send a POST request to your Go server with the access time
    fetch('http://localhost:8000/ping', {
        method: 'POST',
        headers: {
            "Access-Control-Allow-Origin": "*",
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            accessTime: accessTime
        })
    })
        .then(response => {
            if (response.ok) {
                console.log('Ping sent successfully.');
            } else {
                console.error('Failed to send ping.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
