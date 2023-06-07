<?php include '../view/header.php'; ?>
<main>
    <h2>Customer Login</h2>
    <p>You must login before you can register a product.</p>
    
    <form action="." method="post">
            <input type="hidden" name="action" value="get_customer">
            <label>Email:</label>
            <input type="hidden" name="email" 
                   value="<?php echo htmlspecialchars($email); ?>">
            <input type="submit" value="Login">
    </form>
            
</main>
<?php include '../view/footer.php'; ?>

