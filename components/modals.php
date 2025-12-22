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
    // Helper functions for modals
    function openModal(id) {
        const modal = document.getElementById(id);
        if (modal) modal.style.display = 'flex';
    }
    function closeModal(id) {
        const modal = document.getElementById(id);
        if (modal) modal.style.display = 'none';
    }
    function switchModal(closeId, openId) {
        closeModal(closeId);
        openModal(openId);
    }
</script>
