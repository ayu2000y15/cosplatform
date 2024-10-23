<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-logo">
            <?php
            require_once('db.php'); 
            $obj = new DbController();
            $row = $obj->getLogoImg();
            
            foreach ($row as $row) {
                echo '<img src="'. htmlspecialchars($row['FILE_PATH']) . htmlspecialchars($row['FILE_NAME']) . '" alt="' . htmlspecialchars($row['ALT']) . '">';
            }
        ?>
                <p>COSPLATFORM</p>
            </div>
            <nav class="footer-nav">
                <a href="about.php">ABOUT</a>
                <a href="talent.php">TALENT</a>
                <a href="cosplay.php">COSPLAY</a>
                <a href="contact.php">CONTACT</a>
            </nav>
            <div class="footer-social">
                <a href="#" aria-label="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                </a>
                <a href="#" aria-label="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line></svg>
                </a>
                <a href="#" aria-label="Twitter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path></svg>
                </a>
            </div>
        </div>
        <p class="copyright">&copy; 2024 COSPLATFORM. All rights reserved.</p>
    </div>
</footer>