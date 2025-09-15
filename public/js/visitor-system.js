// Visitor System - Simple and Reliable
(function() {
    'use strict';
    
    // Check if visitor has name
    function hasVisitorName() {
        const name = localStorage.getItem('visitor_name');
        const hasName = name && name.trim() !== '';
        console.log('hasVisitorName check:', { name, hasName });
        return hasName;
    }
    
    // Get visitor name
    function getVisitorName() {
        return localStorage.getItem('visitor_name') || '';
    }
    
    // Get visitor email
    function getVisitorEmail() {
        return localStorage.getItem('visitor_email') || '';
    }
    
    // Save visitor data
    function saveVisitorData(name, email) {
        localStorage.setItem('visitor_name', name.trim());
        if (email) {
            localStorage.setItem('visitor_email', email.trim());
        }
        console.log('Visitor data saved:', { name, email });
    }
    
    // Clear visitor data
    function clearVisitorData() {
        localStorage.removeItem('visitor_name');
        localStorage.removeItem('visitor_email');
        console.log('Visitor data cleared');
    }
    
    // Show visitor popup
    function showVisitorPopup() {
        // Remove existing popup if any
        const existingPopup = document.getElementById('visitor-popup');
        if (existingPopup) {
            existingPopup.remove();
        }
        
        // Create popup
        const popup = document.createElement('div');
        popup.id = 'visitor-popup';
        popup.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            z-index: 10000;
            display: flex;
            justify-content: center;
            align-items: center;
        `;
        
        popup.innerHTML = `
            <div style="
                background: white;
                padding: 30px;
                border-radius: 10px;
                max-width: 400px;
                width: 90%;
                text-align: center;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            ">
                <h3 style="margin-bottom: 20px; color: #333;">مرحباً بك!</h3>
                <p style="margin-bottom: 20px; color: #666;">يرجى إدخال اسمك للبدء في المحادثة</p>
                
                <form id="visitor-form">
                    <div style="margin-bottom: 15px;">
                        <input type="text" id="visitor-name" placeholder="اسمك" required 
                               style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                    </div>
                    <div style="margin-bottom: 20px;">
                        <input type="email" id="visitor-email" placeholder="البريد الإلكتروني (اختياري)" 
                               style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
                    </div>
                    <button type="submit" style="
                        background: #007bff;
                        color: white;
                        border: none;
                        padding: 12px 30px;
                        border-radius: 5px;
                        font-size: 16px;
                        cursor: pointer;
                        width: 100%;
                    ">متابعة</button>
                </form>
            </div>
        `;
        
        document.body.appendChild(popup);
        
        // Handle form submission
        const form = document.getElementById('visitor-form');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = document.getElementById('visitor-name').value.trim();
            const email = document.getElementById('visitor-email').value.trim();
            
            if (!name) {
                alert('يرجى إدخال اسمك');
                return;
            }
            
            // Save visitor data
            saveVisitorData(name, email);
            
            // Close popup
            popup.remove();
            
            // Trigger event
            const event = new CustomEvent('visitorRegistered', {
                detail: { name, email }
            });
            document.dispatchEvent(event);
            
            console.log('Visitor registered:', { name, email });
        });
        
        // Close popup when clicking outside
        popup.addEventListener('click', function(e) {
            if (e.target === popup) {
                popup.remove();
            }
        });
    }
    
    // Expose functions globally
    window.VisitorSystem = {
        hasName: hasVisitorName,
        getName: getVisitorName,
        getEmail: getVisitorEmail,
        showPopup: showVisitorPopup,
        clear: clearVisitorData
    };
    
    console.log('Visitor System loaded - Version 2.0');
})();
