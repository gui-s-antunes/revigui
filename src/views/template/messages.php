<?php if($_SESSION['message']): ?>
    <div class="exception">
        <p><i class="icofont-exclamation-square my-2"></i><?= $_SESSION['message']['msg'] ?></p>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif ?>

<?php if(isset($exception)): ?>

<div class="exception">
    <p><i class="icofont-exclamation-square my-2"></i><?= $exception->getMessage() ?></p>
</div>

<?php
$error = [];
    $errors = $exception->getErrors(); // returns all errors reported at throw new ValidationError array param
    if(count($errors) > 0){
        foreach($errors as $key => $value){
            $error[$key] = $value;
        }
    }
?>

<?php endif ?>



