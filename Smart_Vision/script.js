// Import the connection functions from the database-connection.js file
import { connectToSoftware, disconnectFromSoftware, isConnected } from './database-connection.js';

document.addEventListener("DOMContentLoaded", function () {
    console.log("Smart Vision loaded successfully.");
    
    // Handle smooth scrolling for all links with the class "scroll-link"
    document.querySelectorAll('.scroll-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Change header appearance on scroll
    window.addEventListener('scroll', function() {
        const header = document.querySelector('header');
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
    
    // Make feature boxes editable on click
    const featureBoxes = document.querySelectorAll('.feature-box');
    
    featureBoxes.forEach(box => {
        // Edit heading functionality
        const heading = box.querySelector('h3');
        heading.addEventListener('click', function() {
            const currentText = this.textContent;
            const input = document.createElement('input');
            input.type = 'text';
            input.value = currentText;
            input.className = 'edit-input';
            input.style.width = '100%';
            input.style.fontSize = '1.5rem';
            input.style.background = 'rgba(255, 255, 255, 0.9)';
            input.style.border = 'none';
            input.style.borderRadius = '5px';
            input.style.padding = '5px 10px';
            
            this.innerHTML = '';
            this.appendChild(input);
            input.focus();
            
            input.addEventListener('blur', function() {
                heading.textContent = this.value;
            });
            
            input.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    heading.textContent = this.value;
                }
            });
        });
        
        // Edit paragraph functionality
        const paragraph = box.querySelector('p');
        paragraph.addEventListener('click', function() {
            const currentText = this.textContent;
            const textarea = document.createElement('textarea');
            textarea.value = currentText;
            textarea.className = 'edit-textarea';
            textarea.style.width = '100%';
            textarea.style.minHeight = '100px';
            textarea.style.background = 'rgba(255, 255, 255, 0.9)';
            textarea.style.border = 'none';
            textarea.style.borderRadius = '5px';
            textarea.style.padding = '10px';
            textarea.style.resize = 'vertical';
            
            this.innerHTML = '';
            this.appendChild(textarea);
            textarea.focus();
            
            textarea.addEventListener('blur', function() {
                paragraph.textContent = this.value;
            });
        });
    });
    
    // Handle sign-in button click
    const signInButton = document.querySelector('nav ul li:last-child a');
    
    if (signInButton) {
        signInButton.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (isConnected) {
                // If already connected, disconnect (sign out)
                disconnectFromSoftware();
            } else {
                // If not connected, show login dialog
                showLoginDialog();
            }
        });
    }
    
    // Listen for connection events
    document.addEventListener('connection-established', function(event) {
        console.log("Connection established event received");
        showNotification("Connected to Examp Software", "success");
    });
    
    document.addEventListener('connection-failed', function(event) {
        console.log("Connection failed event received:", event.detail.error);
        showNotification("Connection failed: " + event.detail.error, "error");
    });
    
    document.addEventListener('connection-terminated', function() {
        console.log("Connection terminated event received");
        showNotification("Disconnected from Examp Software", "info");
    });
    
    // Optional: Add auto-play functionality for audio (since most browsers block autoplay)
    const audio = document.getElementById('background-audio');
    
    // Add a click event to the document to start playing audio
    document.addEventListener('click', function() {
        if (audio.paused) {
            audio.play().catch(error => {
                console.log("Audio playback prevented:", error);
            });
        }
    }, { once: true }); // Only trigger once
});

// Function to show login dialog
function showLoginDialog() {
    // Create login dialog elements
    const dialogOverlay = document.createElement('div');
    dialogOverlay.className = 'dialog-overlay';
    dialogOverlay.style.position = 'fixed';
    dialogOverlay.style.top = '0';
    dialogOverlay.style.left = '0';
    dialogOverlay.style.width = '100%';
    dialogOverlay.style.height = '100%';
    dialogOverlay.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
    dialogOverlay.style.display = 'flex';
    dialogOverlay.style.justifyContent = 'center';
    dialogOverlay.style.alignItems = 'center';
    dialogOverlay.style.zIndex = '9999';
    
    const dialogBox = document.createElement('div');
    dialogBox.className = 'dialog-box';
    dialogBox.style.backgroundColor = 'rgba(255, 255, 255, 0.9)';
    dialogBox.style.color = '#333';
    dialogBox.style.borderRadius = '10px';
    dialogBox.style.padding = '30px';
    dialogBox.style.width = '90%';
    dialogBox.style.maxWidth = '400px';
    dialogBox.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.2)';
    
    // Create dialog content
    dialogBox.innerHTML = `
        <h2 style="margin-top: 0; margin-bottom: 20px; color: #333;">Connect to Examp Software</h2>
        
        <div style="margin-bottom: 15px;">
            <label for="username" style="display: block; margin-bottom: 5px; font-weight: 600;">Username:</label>
            <input type="text" id="username" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
        </div>
        
        <div style="margin-bottom: 20px;">
            <label for="password" style="display: block; margin-bottom: 5px; font-weight: 600;">Password:</label>
            <input type="password" id="password" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
        </div>
        
        <div style="display: flex; justify-content: space-between;">
            <button id="cancel-login" style="padding: 10px 15px; border-radius: 5px; background: #ccc; border: none; cursor: pointer;">Cancel</button>
            <button id="confirm-login" style="padding: 10px 15px; border-radius: 5px; background: #3498db; color: white; border: none; cursor: pointer;">Connect</button>
        </div>
    `;
    
    // Add dialog to document
    dialogOverlay.appendChild(dialogBox);
    document.body.appendChild(dialogOverlay);
    
    // Focus username field
    setTimeout(() => {
        document.getElementById('username').focus();
    }, 100);
    
    // Handle cancel button
    document.getElementById('cancel-login').addEventListener('click', function() {
        document.body.removeChild(dialogOverlay);
    });
    
    // Handle connect button
    document.getElementById('confirm-login').addEventListener('click', function() {
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value;
        
        if (!username) {
            alert('Please enter a username');
            return;
        }
        
        if (!password) {
            alert('Please enter a password');
            return;
        }
        
        // Dispatch auth event with credentials
        const authEvent = new CustomEvent('auth-event', {
            detail: {
                action: 'login',
                credentials: {
                    username: username,
                    password: password
                }
            }
        });
        
        document.dispatchEvent(authEvent);
        
        // Remove dialog
        document.body.removeChild(dialogOverlay);
    });
    
    // Allow pressing Enter to submit
    dialogBox.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            document.getElementById('confirm-login').click();
        }
    });
}

// Function to show notifications
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = 'notification ' + type;
    notification.style.position = 'fixed';
    notification.style.top = '20px';
    notification.style.right = '20px';
    notification.style.padding = '15px 20px';
    notification.style.borderRadius = '5px';
    notification.style.color = 'white';
    notification.style.zIndex = '10000';
    notification.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
    notification.style.transition = 'opacity 0.3s, transform 0.3s';
    notification.style.opacity = '0';
    notification.style.transform = 'translateY(-20px)';
    
    // Set background color based on notification type
    if (type === 'success') {
        notification.style.backgroundColor = '#2ecc71';
    } else if (type === 'error') {
        notification.style.backgroundColor = '#e74c3c';
    } else {
        notification.style.backgroundColor = '#3498db';
    }
    
    notification.textContent = message;
    
    // Add to document
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.opacity = '1';
        notification.style.transform = 'translateY(0)';
    }, 10);
    
    // Remove after delay
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transform = 'translateY(-20px)';
        
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 4000);
}