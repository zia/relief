<?php
  require_once 'config.php';
  include('header.php');
	if(!isset($_SESSION["user_login"])) {
		header("location: login.php");
  }
  if(!isset($_SESSION['token'])){
    throw new Exception('No token found!');
  }
?>

<div class="s130">
    <form class="regSearch" method="post" action="<?=htmlspecialchars("repDetails.php");?>">
      <div class="inner-form">
        <div class="input-field first-wrap">
          <div class="svg-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
            </svg>
          </div>
          <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
          <input id="search" type="text" placeholder="এনআইডি / মোবাইল দিয়ে ত্রাণগ্রহীতা খুঁজুন" autocomplete="off" required/>
        </div>
        <div class="input-field second-wrap">
          <button class="btn-search" type="submit">অনুসন্ধান</button>
        </div>
      </div>
      <span class="info">
        <div id="txtHint"></div>
      </span>
    </form>
</div>

<?php include('footer.php');?>
