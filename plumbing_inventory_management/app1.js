let currentFile = 'swr.php';

// Handles the page loading
document.addEventListener('DOMContentLoaded', function() {
    const sidebarItems = document.querySelectorAll('.sidebar-item');
    const contentDiv = document.querySelector('.content');

    sidebarItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all sidebar items
            sidebarItems.forEach(i => i.classList.remove('active'));

            // Add active class to the clicked item
            item.classList.add('active');

            // Get the PHP file name from data-file attribute
            currentFile = item.getAttribute('data-file');

            // Create an XMLHttpRequest object to load the content
            const xhr = new XMLHttpRequest();
            xhr.open('GET', currentFile, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Update the content div with the loaded content
                    contentDiv.innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        });
    });

    // Ensures the CSS style remains intact
    document.querySelector('.sidebar-item.active').click();
});

// Function handling update
function updateQuantity(action, table, item, currentQuantity) {
    // Prompt the user to enter the quantity
    let quantity = prompt(`Enter the quantity to ${action} for ${item} (Current: ${currentQuantity}):`);

    // Ensure the input is a number
    quantity = parseInt(quantity);

    if (action === 'consume' && quantity > currentQuantity) {
        alert(`Cannot consume more than the current quantity (${currentQuantity}).`);
        return;
    }

    // Determine the URL based on the action
    let url = action === 'add' ? 'update_add.php' : 'update_consume.php';

    // Create a new XMLHttpRequest object
    let xhr = new XMLHttpRequest();

    // Configure it: POST-request for the URL
    xhr.open('POST', url, true);

    // Set up the request headers
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Set up a callback function to handle the response
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Display the server response
            alert(xhr.responseText);

            // Reload the current file to reflect the updated quantity
            loadCurrentFile();
        }
    };

    // Send the request with the item, quantity, and table name
    xhr.send(`item=${encodeURIComponent(item)}&quantity=${quantity}&table=${encodeURIComponent(table)}`);
}

// Function to reload the current file
function loadCurrentFile() {
    const contentDiv = document.querySelector('.content');

    // Create an XMLHttpRequest object to load the content
    const xhr = new XMLHttpRequest();
    xhr.open('GET', currentFile, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Update the content div with the loaded content
            contentDiv.innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
