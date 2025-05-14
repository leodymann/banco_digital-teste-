<?php 
session_start();
if(!isset($_SESSION['user_id'])){
    header('Location: login_form.php');
    exit();
}

$userName = $_SESSION['user_name'];
$userId = $_SESSION['user_id'];
//futuramente puxarei o saldo tambem
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="/banco_digital/bank_proj/css/style.css">
</head>
<body>
    <div class="container-link">
        <h1 class="h1_dash">welcome, @<?php echo $userName; ?>.</h1>    
    </div>
    <div class="card-container">
        <div class="card">
            <a href="transfer_form.php"><h3 class="card__title"> transfer menu
            </h3></a>
            <p class="card__content">safe, fast transfers wherever you are.</p>
            <div class="card__date">
                Bank Digital
            </div>
            <div class="card__arrow">
                <a href="transfer_form.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15" width="15">
                        <path fill="#fff" d="M13.4697 17.9697C13.1768 18.2626 13.1768 18.7374 13.4697 19.0303C13.7626 19.3232 14.2374 19.3232 14.5303 19.0303L20.3232 13.2374C21.0066 12.554 21.0066 11.446 20.3232 10.7626L14.5303 4.96967C14.2374 4.67678 13.7626 4.67678 13.4697 4.96967C13.1768 5.26256 13.1768 5.73744 13.4697 6.03033L18.6893 11.25H4C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75H18.6893L13.4697 17.9697Z"></path>
                    </svg>
                </a>
            </div>
        </div>
        <div class="card">
            <a href="balance_view.php"><h3 class="card__title"> your balance
            </h3></a>
            <p class="card__content">see your balance, statement and expenses.</p>
            <div class="card__date">
                Bank Digital
            </div>
            <div class="card__arrow">
                <a href="balance_view.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15" width="15">
                        <path fill="#fff" d="M13.4697 17.9697C13.1768 18.2626 13.1768 18.7374 13.4697 19.0303C13.7626 19.3232 14.2374 19.3232 14.5303 19.0303L20.3232 13.2374C21.0066 12.554 21.0066 11.446 20.3232 10.7626L14.5303 4.96967C14.2374 4.67678 13.7626 4.67678 13.4697 4.96967C13.1768 5.26256 13.1768 5.73744 13.4697 6.03033L18.6893 11.25H4C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75H18.6893L13.4697 17.9697Z"></path>
                    </svg>
                </a>
            </div>
        </div>
        <div class="card">
            <a href="deposit_form.php"><h3 class="card__title"> make deposits
            </h3></a>
            <p class="card__content">make fast and secure deposits.</p>
            <div class="card__date">
                Bank Digital
            </div>
            <div class="card__arrow">
                <a href="deposit_form.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15" width="15">
                        <path fill="#fff" d="M13.4697 17.9697C13.1768 18.2626 13.1768 18.7374 13.4697 19.0303C13.7626 19.3232 14.2374 19.3232 14.5303 19.0303L20.3232 13.2374C21.0066 12.554 21.0066 11.446 20.3232 10.7626L14.5303 4.96967C14.2374 4.67678 13.7626 4.67678 13.4697 4.96967C13.1768 5.26256 13.1768 5.73744 13.4697 6.03033L18.6893 11.25H4C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75H18.6893L13.4697 17.9697Z"></path>
                    </svg>
                </a>
            </div>
        </div>
        <div class="card">
            <a href="/banco_digital/bank_proj/controllers/logout.php"><h3 class="card__title"> make logout
            </h3></a>
            <p class="card__content">end your session securely.</p>
            <div class="card__date">
                Bank Digital
            </div>
            <div class="card__arrow">
                <a href="/banco_digital/bank_proj/controllers/logout.php">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15" width="15">
                        <path fill="#fff" d="M13.4697 17.9697C13.1768 18.2626 13.1768 18.7374 13.4697 19.0303C13.7626 19.3232 14.2374 19.3232 14.5303 19.0303L20.3232 13.2374C21.0066 12.554 21.0066 11.446 20.3232 10.7626L14.5303 4.96967C14.2374 4.67678 13.7626 4.67678 13.4697 4.96967C13.1768 5.26256 13.1768 5.73744 13.4697 6.03033L18.6893 11.25H4C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75H18.6893L13.4697 17.9697Z"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</body>
<style>
    .card-container{
        display: flex;
        padding: 10px;
        justify-content: center;
        gap: 50px;
        margin-top: 60px;
    }
    .card {
    --border-radius: 0.75rem;
    --primary-color:rgb(0, 0, 0);
    --secondary-color: #3c3852;
    width: 210px;
    font-family: "Arial";
    padding: 1rem;
    cursor: pointer;
    border-radius: var(--border-radius);
    background: #f1f1f3;
    box-shadow: 0px 8px 16px 0px rgb(0 0 0 / 3%);
    position: relative;
    }

    .card a{
        color: #111111;
    }

    .card > * + * {
    margin-top: 1.1em;
    }

    .card .card__content {
    color: var(--secondary-color);
    font-size: 0.86rem;
    }

    .card .card__title {
    padding: 0;
    font-size: 1.3rem;
    font-weight: bold;
    }

    .card .card__date {
    color: #6e6b80;
    font-size: 0.8rem;
    }

    .card .card__arrow {
    position: absolute;
    background: var(--primary-color);
    padding: 0.4rem;
    border-top-left-radius: var(--border-radius);
    border-bottom-right-radius: var(--border-radius);
    bottom: 0;
    right: 0;
    transition: 0.2s;
    display: flex;
    justify-content: center;
    align-items: center;
    }

    .card svg {
    transition: 0.2s;
    }

    /* hover */
    .card:hover .card__title {
    color: var(--primary-color);
    text-decoration: underline;
    }

    .card:hover .card__arrow {
    background: #111;
    }

    .card:hover .card__arrow svg {
    transform: translateX(3px);
    }
    h1{
        color: #ffffff;
    }
</style>
</html>