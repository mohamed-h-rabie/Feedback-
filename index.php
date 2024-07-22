
   <?php include('inc/header.php') ?>
 <?php include("./config/database.php")?>
 <?php 
 //set initial values
 $name=$email=$body='';
 $nameErr=$emailErr=$bodyErr='';


 //submitting form 
 if(isset($_POST['submit'])){
  //valdiation all form 
  if(empty($_POST['name'])){
    $nameErr ='name is required';
  }else{
    $name =filter_input(
      INPUT_POST,
      'name',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }

  if(empty($_POST['email'])){
    $nameErr ='email is required';
  }else{
    $email =filter_input(
      INPUT_POST,
      'email',
      FILTER_SANITIZE_EMAIL
    );
  }


  if(empty($_POST['body'])){
    $nameErr ='body is required';
  }else{
    $body =filter_input(
      INPUT_POST,
      'body',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }


 if (empty($nameErr) && empty($emailErr) && empty($bodyErr)) {
  // /insert data to form
  $sql = "INSERT INTO feedback (name,email,body) VALUES ('$name', '$email', '$body')";
if(mysqli_query($conn , $sql)) {
  header('Location: feedback.php');

} else{
  echo "Error: ". $sql. "<br>". mysqli_error($conn);
}
}
} 
 ?>

   <h2>Feedback</h2>

   <p class="lead text-center">Leave feedback </p>
   <form method="POST" action="<?php echo htmlspecialchars(
      $_SERVER['PHP_SELF']
    ); ?>" class="mt-4 w-75">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?php echo !$nameErr ?:
          'is-invalid'  ; ?>" id="name" name="name" placeholder="Enter your name" value="<?php echo $name; ?>">
        <div id="validationServerFeedback" class="invalid-feedback">
          Please provide a valid name.
        </div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?php echo !$emailErr ?:
          'is-invalid'; ?>" id="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>">
      </div>
      <div class="mb-3">
        <label for="body" class="form-label">Feedback</label>
        <textarea class="form-control <?php echo !$bodyErr ?:
          'is-invalid'; ?>" id="body" name="body" placeholder="Enter your feedback"><?php echo $body; ?></textarea>
      </div>
      <div class="mb-3">
        <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
      </div>
    </form>
    <?php include('inc/footer.php') ?>