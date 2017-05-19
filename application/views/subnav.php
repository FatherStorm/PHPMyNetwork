<a href="#" class='toggleDetails right'><button>Toggle Details</button></a>

<?php if($configure==true){?>
    <a href='/main' class="right"><button><?php echo $loggedIn==true?'Configure':'Log In';?></button></a>
<?php } ?>


<?php //if($ping==true){?>
<!--    <a href='#' class="ping right"><button>--><?php //echo $loggedIn==true?'Ping':'';?><!--</button></a>-->
<?php //} ?>

<a href='/auth/<?php echo $loggedIn==true?'logout':'create_user';?>'class="right"><button><?php echo $loggedIn==true?'Log Out':'Sign Up';?></button></a>