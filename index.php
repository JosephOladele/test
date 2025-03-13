<?php require 'pj2.php'; // Include database connection 
$feedback = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {     
    $name = strip_tags(trim($_POST['name']));     
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);     
    $message = strip_tags(trim($_POST['message']));     

    if ($name && $email && $message) {         
        $sql = "INSERT INTO contact_messages (name, email, message) VALUES (:name, :email, :message)";         
        $stmt = $pdo->prepare($sql);         

        if ($stmt->execute([':name' => $name, ':email' => $email, ':message' => $message])) {             
            $feedback = "Thank you for contacting Crestwood University News!";         
        } else {             
            $feedback = "Error: Unable to submit your message.";         
        }     
    } else {         
        $feedback = "Invalid input. Please check your details.";     
    }
}
?>   

<!DOCTYPE html>
<html lang="en">
<head>     
    <meta charset="UTF-8">     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">     
    <title>Crestwood University News - Contact Us</title>     
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 700px;
            margin: 40px auto;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
        }

        .header {
            background: linear-gradient(90deg, #4568dc, #b06ab3);
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .header h1 {
            margin: 0;
            color: white;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .header-divider {
            width: 70px;
            height: 5px;
            background-color: #fff;
            margin: 15px auto 5px;
            border-radius: 10px;
        }

        .header p {
            color: rgba(255, 255, 255, 0.9);
            margin: 5px 0 0;
            font-size: 16px;
        }

        .contact-info {
            display: flex;
            flex-wrap: wrap;
            padding: 25px 30px;
            background-color: #f8f9fa;
            justify-content: center;
            border-bottom: 1px solid #eee;
        }

        .contact-item {
            display: flex;
            align-items: center;
            margin: 10px 20px;
        }

        .contact-item i {
            color: #4568dc;
            font-size: 18px;
            margin-right: 10px;
        }

        .contact-item span {
            font-size: 15px;
        }

        .form-section {
            padding: 30px 40px;
        }

        .feedback-message {
            background-color: #e7f5fe;
            color: #4568dc;
            padding: 15px;
            margin-bottom: 25px;
            border-radius: 10px;
            text-align: center;
            font-weight: 500;
            border-left: 5px solid #4568dc;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
            font-size: 15px;
        }

        .input-container {
            position: relative;
        }

        .input-container i {
            position: absolute;
            left: 15px;
            top: 13px;
            color: #aaa;
        }

        .form-control {
            width: 100%;
            padding: 12px 12px 12px 45px;
            border: 2px solid #eaeaea;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s;
            box-sizing: border-box;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .submit-btn {
            width: 100%;
            background: linear-gradient(90deg, #4568dc, #b06ab3);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
            letter-spacing: 0.5px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
        }

        .social-section {
            margin-top: 30px;
            text-align: center;
        }

        .social-section p {
            font-size: 14px;
            color: #777;
            margin-bottom: 15px;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-icon {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f2f2f2;
            color: #4568dc;
            text-decoration: none;
            transition: all 0.3s;
        }

        .social-icon:hover {
            background-color: #4568dc;
            color: white;
            transform: translateY(-3px);
        }

        .footer {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: center;
            font-size: 13px;
            color: #777;
            border-top: 1px solid #eee;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>     
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>Crestwood University News - Contact Us</h1>
            <div class="header-divider"></div>
            <p>We'd love to hear from you</p>
        </div>

        <!-- Contact Info Section -->
        <div class="contact-info">
            <div class="contact-item">
                <i class="fas fa-envelope"></i>
                <span>news@crestwood.edu</span>
            </div>
            <div class="contact-item">
                <i class="fas fa-phone"></i>
                <span>(555) 123-4567</span>
            </div>
            <div class="contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <span>123 University Ave, Campus Center</span>
            </div>
        </div>

        <!-- Form Section -->
        <div class="form-section">
            <?php if (!empty($feedback)) {
                echo "<div class='feedback-message'>$feedback</div>";
            } ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <div class="input-container">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" id="name" required class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Your Email</label>
                    <div class="input-container">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" id="email" required class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="message">Your Message</label>
                    <div class="input-container">
                        <i class="fas fa-comment-alt"></i>
                        <textarea name="message" id="message" rows="5" required class="form-control"></textarea>
                    </div>
                </div>

                <button type="submit" class="submit-btn">Send Message <i class="fas fa-paper-plane"></i></button>
            </form>

            <!-- Social Icons -->
            <div class="social-section">
                <p>Connect with us</p>
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2025 Crestwood University News. All rights reserved.</p>
        </div>
    </div>
</body>
</html>