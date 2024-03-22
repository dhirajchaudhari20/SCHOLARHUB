<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Chat</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional CSS styling */
        .container {
            margin-top: 50px;
        }
        .comment {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .comment-info {
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Community Chat</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="Enter your comment" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
        
        <div class="mt-4">
            <h3>Previous Comments</h3>
            <?php
            // Database connection
            $conn = mysqli_connect('localhost', 'root', '', 'community_chat');
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Insert new comment into the database on form submission
            if (isset($_POST['submit'])) {
                $email = $_POST['email'];
                $comment = $_POST['comment'];
                $sql = "INSERT INTO comments (email, comment) VALUES ('$email', '$comment')";
                if (mysqli_query($conn, $sql)) {
                    echo "<p class='text-success'>New comment added successfully</p>";
                } else {
                    echo "<p class='text-danger'>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
                }
            }

            // Retrieve comments from the database
            $sql = "SELECT email, comment FROM comments";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // Output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='comment'>";
                    echo "<p class='comment-info'><strong>Email:</strong> " . $row["email"] . "</p>";
                    echo "<p><strong>Comment:</strong> " . $row["comment"] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>No comments yet.</p>";
            }

            // Close database connection
            mysqli_close($conn);
            ?>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
