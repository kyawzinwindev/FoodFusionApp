<!-- LOGIN MODAL -->
<div id="loginModal" class="popup-overlay">
    <div class="popup-box">
        <span class="popup-close" onclick="closeModal('loginModal')">&times;</span>
        <h2 class="popup-title">Log In</h2>
        <form action="./controllers/login_controller.php" method="POST" class="popup-form"> 
            <input type="email" name="email" placeholder="Email" required class="popup-input">
            <input type="password" name="password" placeholder="Password" required class="popup-input">
            <button type="submit" name="btnLogin" class="popup-submit">Log In</button>
        </form>
        <p class="modal-footer" style="text-align:center; margin-top:15px;">Don't have an account? <a href="#" onclick="switchModal('loginModal','registerModal')" style="color:#ff7a30; font-weight:bold;">Sign Up</a></p>
    </div>
</div>

<!-- REGISTER MODAL -->
<div id="registerModal" class="popup-overlay">
    <div class="popup-box">
        <span class="popup-close" onclick="closeModal('registerModal')">&times;</span>
        <h2 class="popup-title">Sign Up</h2>
        <form action="./controllers/registration_controller.php" method="POST" class="popup-form">
            <input type="text" name="first_name" placeholder="First Name" required class="popup-input">
            <input type="text" name="last_name" placeholder="Last Name" required class="popup-input">
            <input type="email" name="email" placeholder="Email" required class="popup-input">
            <input type="password" name="password" placeholder="Password" required class="popup-input">
            <button type="submit" name="btnRegister" class="popup-submit">Sign Up</button>
        </form>
        <p class="modal-footer" style="text-align:center; margin-top:15px;">Already have an account? <a href="#" onclick="switchModal('registerModal','loginModal')" style="color:#ff7a30; font-weight:bold;">Log In</a></p>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }
    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }
    function switchModal(closeId, openId) {
        closeModal(closeId);
        openModal(openId);
    }
    // Close on click outside
    window.onclick = function(event) {
        if (event.target.classList.contains('popup-overlay')) {
            event.target.style.display = "none";
        }
    }

    // Attach to buttons if they exist
    document.addEventListener('DOMContentLoaded', function() {
        const loginBtn = document.getElementById('openLogin');
        if(loginBtn) {
            loginBtn.addEventListener('click', function() {
                openModal('loginModal');
            });
        }
    });
</script>
