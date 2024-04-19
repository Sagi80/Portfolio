<?php
session_start();
require_once $_SESSION['CONTROLLERS_PATH'] . '/PortfolioController.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $controller = new PortfolioController();
    $proyectos = new ProjectController();

    $portfolio = $controller->show($id);
    $projects =  $proyectos->get_project_ctrl($id);
  
    
    if ($portfolio) {

    echo" <!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <!--Bootstrap icons-->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css'>
    <!--Fuente-->
    <link href='https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet'>
    <!--bootstrap-->
    <link rel='stylesheet' href='https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css'>
    <!--CSS-->
    <link rel ='stylesheet' href='../../../public/assets/css/portfolio.css'>
    <title>Portfolio</title>
</head>
<body>

  <div class='container contenedor-principal'>
<!--------------------------------------------------------------------------Barra de navegacion----------------------------------------------------------->
    <section class='Navegacion'>
      <nav class='navbar navbar-expand-lg p-3'>
        <div class='container d-flex justify-content-between'>
          <a class='excluir' class='navbar-brand' href='#'>
            <img src='../../../public/assets/img/logo.png' alt='Logo' height='70' class='d-inline-block align-text-top'>
          </a>
          <!----------------------------------------------Botones--------------------------------------->
          <div class='excluir' class='container'>";
              echo "<a id='btnOrange' class='btn btn-warning btn-md mx-2' href='index.php'>Volver a la lista</a>";
              echo "<a id='btnOrange' class='btn btn-warning btn-md mx-2' href='edit.php?id=" . $portfolio['pk_portfolio'] . "'>Editar este portfolio</a>";
              echo "<button id='descargarPortfolio' class='btn btn-md mx-2'>Descargar Portfolio</button>";
              } else {
              echo "<p>Portfolio no encontrado.</p>";
              }
              } else {
              echo "<p>ID no válido o no proporcionado.</p>";
              }
              echo "
          </div>
          <!---------------------------------------------Despliegue Menu--------------------------------->
          <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNavDropdown' aria-controls='navbarNavDropdown' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
          </button>
        </div>
        <div class='collapse navbar-collapse' id='navbarNavDropdown'>
            <ul class='navbar-nav'>
              <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                  Secciones
                </a>
                <ul class='dropdown-menu'>
                  <li><a class='dropdown-item' href='#ancla-sobremi'>Sobre mi</a></li>
                  <li><a class='dropdown-item' href='#ancla-proyectos'>proyectos</a></li>
                  <li><a class='dropdown-item' href='#ancla-skills'>skills</a></li>
                </ul>
              </li>
            </ul>
        </div>
    </nav>
    </section>
   <!---------------------------------------------------------------Seccion principal----------------------------------------------------------------------->
   <section class='principal row pt-4'>
    <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex flex-column align-items-center'>
        <div class='titulos text-left mb-3 w-75'>
            <p class='h2 saludo text-left'>Hola mi nombre es</p>
            <p class='h1 nombre text-left'>".$portfolio['por_nombre']." ".$portfolio['por_apellidos']."</p>
            <p class='h6 text-left mb-3'>".$portfolio['por_especialidad']."</p>
        </div>
    </div>
    <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-end'>
        <div class='d-flex flex-column align-items-center'>";

        echo "<div class='d-flex align-items-center'>"; // Contenedor con display flex

        if (!empty(trim($portfolio['por_tik_tok']))) {
            echo "<a style='color: #000000;' href='" . $portfolio['por_tik_tok'] . "' target='_blank' role='button'><i class='bi bi-tiktok mr-4'></i></a>";
        }
        
        if (!empty(trim($portfolio['por_github']))) {
            echo "<a style='color: #000000;' href='" . $portfolio['por_github'] . "' target='_blank' role='button'><i class='bi bi-github mr-4'></i></a>";
        }
        
        if (!empty(trim($portfolio['por_instagram']))) {
            echo "<a style='color: #c13584;' href='" . $portfolio['por_instagram'] . "' target='_blank' role='button'><i class='bi bi-instagram mr-4'></i></a>";
        }
        
        if (!empty(trim($portfolio['por_linkedin']))) {
            echo "<a style='color: #0077B5;' href='" . $portfolio['por_linkedin'] . "' target='_blank' role='button'><i class='bi bi-linkedin mr-4'></i></a>";
        }
        
        if (!empty(trim($portfolio['por_twitter']))) {
            echo "<a style='color: #00acee;' href='" . $portfolio['por_twitter'] . "' target='_blank' role='button'><i class='bi bi-twitter mr-4'></i></a>";
        }
        
        echo "</div>"; // Cierre del contenedor flex
        
if (!empty(trim($portfolio['por_cv']))) {
    $url = "../" . $portfolio['por_cv'];
    $base64Pdf = convertImageToBase64($url);
    $base64PdfLink = "data:application/pdf;base64," . $base64Pdf;
    echo "<a href='" . htmlspecialchars($base64PdfLink, ENT_QUOTES, 'UTF-8') . "' download='CV.pdf' style='color: blue;' role='button'><i class='bi bi-download mr-4'></i>Descargar CV</a>";
}

echo "</div>
    </div>
</section>;


<!--------------------------------------------------------------- Sobre mi ----------------------------------------------------------------------->

<section class='sobre-mi row p-3' id='ancla-sobremi'>
  <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
    <div class=''>
      <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAVwAAADBCAYAAACDmQgFAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAADPMSURBVHhe7Z0JnBTVncd/3Pd9DTIMIDfKKcitnGImHpvExJwmm8McJprNsdlsYjQmMYkbc2iyu5pzTXSzuZNdUQEB5ZBLQEAuuRkYGM5huAdwf/9+b0wxTndXd72urur5fz9U93s1B9PdVb/3f+/9jwavEyiKoig5p6F9VhRFUXKMCq6iKEpIqOAqiqKEhAquoihKSKjgKoqihIQKrqIoSkio4CqKooSECq6iKEpIqOAqiqKEhAquoihKSKjgKoqihIQKrqIoSkio4CqKooSECq6iKEpIqOAqiqKEhAquoihKSKjgKoqihIQKrqIoSkio4CqKooSECq6iKEpIqOAqiqKEhFbtVQqQszyO8zjGozmP9jza8VD7Qskv8RbcSyuBgy/aTgC6f4wPbU07bMofto0c0qgpj1ZAk9ZAYx5N2G7chp9+Cb/Y2XxPLFkPHOE1cOxl8yxHOpryc+48Dug4FugwFGgziif7mq+FRdDPvGURx4/32Y4ryvh3/Y9tZ0D3T/KhpWnXyWn+3v+w7ZjTdRLvI143AYiv4K67ldfI32zHAf3v5PGY7YTAqf8FXrjFdvJIo2YUHopOp9EUIT53uIYnKURR5fwCYN8zwM4naMgetCcDIjdSj3+gePDItfgu4/t8lANEUAZ+hn/qI7YTlAvA7Ca2nSEtewJT9thOLU4/DSy8yXYKhH4fBQb81HYyJ56Ce3E58BytFNdc/1egVUgiuJDW5em9thMxxAIumgVc8RYK8Y08UWzO541LtJJ+AGz5Ue7fs5J3AoM+yxnABHvCMbMb2EZArrgBGPGc7QSFM4XZw2w7C0rX8aGOQXotr6H9c2yngEj2en0Qz0Wt3b+zDcds/5lthEBUxVaoPgXs/ROw/GO8EWnBrKPld3au/WLIyPR7YW9gzRfCec/2/B6YMxHY8C4afkvtSUVxQzwFd88fbMMxZZzmw9E0tZAoo+U/nxbV6mlAFQUpDGQWs2J8eEJbmxrh3feAPaEowYmf4J5+lkeSNSMXVIQkKHHkwAJgES2/sq/bEzmi/LtmyejwMnsij7xyH7BqKvD6K/aEomRP/AR3b44FseyPtqEkZd39tHan245j1r+dVu2/2E5EqFgIPDMCOP4be0JRsiNmgnvBTPVyyQHeXHjNtJXkHJgPzBPfVocsHcYB9c+2E0GWfsCsKStKlsRLcCspttVVtpND9udojbjQOH/C7ES7YE5LWpDrbSfCyJqyiq6SJfES3FxbtzWE9f8UAuL2U3af7WTJqsmcvJyxnRggovv6attRFP/ESHAPhTfdPLpGb6hM2PR928iCPfcCFYttJ0Y8IwEi201bUXwSH8E9FPI0f7daub6pPpmdu5hMzTd803ZiyFKJTKs2bUXxQXwEN9feCbUp03XcjNj8Q9vwC2csr37Dth3T820m9HXEg8BVXwb6fgjoPN5+0SHHN9BCVz9dxT8xCe19DZg9wLZDZMZ8oOlU23GMqxBPYeT3gO53sNHF9OukCjgvSV54bPw2cO6IPe+Q0gwupe13A1setR1HSEjulTzQy/Rrc2YOsO0xE0XnktKtfOhv2umoT6G98ntX3BkNf2oXNO8G9OF91ucheyJz4iG4+2mprP2K7YTIgLuAfj+2Hce4FNzSCj6kEtvaHAN2fgvY5Hi3vbSMDz1MOxWS5e3Za23HEROfAtq9x3bSsOtfOOh813Yc0OcDwOAnbCcN9UpwHXD4PynakpHMAQM+xfv5J7aTH+KxpJCr3Anp2BuXZYVMxFboQJGgVdz/47bviOpttpEG15atWNZ+xVbo/R1gyv/ZjgN2/poPMXBpiyOdJ9qGA1pdaRv5I/qCe2kFDbI8hVWeOQiccpgCMmr0p/UgaRldccLPrv0hK1COyFY4W77VZAZzhcvXpBQs0RfcfFm3NeQqUU5U6HKdbThA0jqmo9zn1NsPRVONcGZL34/YhgMkP6+ipCH6gptvwUssK0jJlgKl62TbcEBbH9byLoeWYM932UaWtJjFaWZv2wmIJEOvfNJ2FKVuoi24Z57jlH637eQJiYCq1IQ2/khTLUFSLrpcHupyu20EoJeD31FDoc+GlMBEW3CD+N6Wbgf6Sa0yBxRyEETFItsISKcxtpGCvX+xDQd0Ei+HDqYdhG4Ol1Rcvj6lIImw4F6kxZCl0BVN48OVnHLeZvpBkQTcstlTiBxeYhsB6e2jqGGZQ0HqHKyY3xu0mGIbjjgZ4WxnSt6JruCeoNhKNqpsqBHaFjcArZI4wWdK2KHFYSChtYc5zQ9K+6toKd5jO8k4wM90s207oJsMqi5oCbTtZ9sO2KvLT0pyoiu4QTJ2dXmHbZASTzsIkfbJPW2f/SJFGSm2kvXKBUO+ZBspOPmSbTiiNUXeFW2H2IYDDmsdNCU5ERXcwxTcLMMvi6XqblfTFkocLStIwu2oZofaKGvV4nif4ri4jG/rY8BrH/97UUYX9PsILdwP2E4KjrrOvtbePjugicNE6lU7bUNR3kw0BTfI9L22wDYab6a8LiiPqJW76ykTmpnqeI7vw4pPUHAfd1eUcfDngQE+Kx0fW2MbrnAouE0d/q4Em+yzolxONAU3W++Exs15H9Zh0bpaVtitbj9vMPwBEx7sF+cWbhP77ACXFq5Q6XpwUQqFCAruNjt9z4JiEdYWpu2l2NGywtFVfFhr2vWVtgOAib8BetxrT/jkTLltRJCmDtzLvJzaZRuKcjnRE9z9ATbLkq7XDgU6OXIjqq+JyRtx9jD8m8CkLUA7Hy5guaSpY4vUtYV7vtI2FOVyoie42eZOaNYZaC0Z+JPQy1GikthkEHOIBJDMeo1WbbYpMk/aZ0c0cbzm6noNt1oFV6mbaAmu5Ek9luWUPd06bZGjddwTW3lDvWA79YAZ84ABj7NRbPpZkaU/dTJcC6RrC7fa8etVCoZoCW6Q6XraqLLeQPcZth2QPfXIuX0e37P1nDmcpfBmjWOLz7mF61pw1cJV6iZagpttsEObPkBzH2LqKtS3vq3j7v0rMH8msOaGLPMDN7fPrnBYLUNo0Mg2HNGwmW0oyuVER3Cl3lS2u7t+hbSzo2WFsweA0w4rBsSF8rnAC7cCKycBJzPJi+DYIr14yjYccaHKNhzRzLHXg1IwREdwg2QG6+lXSDvze1NsrGVCffbJPbQEePFtwLa72PETVux4yn7B8SZctWMBd70mrBQMERHcS8FyJzTKoIBdZ1pnLkiUUa827frK1n8HlvlJb+j4Mrvg2sKNuBeFUjBEQ3ATmcECbDQsGgasneXvcJVDQKyiynq2llsXR18G1vuYYTRpbRsOcG7hOv59zYtsoy6iM6lUwicaZdI3vJMWbgyn6D05rR6aZZIdl2XS2/QFunMwSVWVVNY9xeXu+DqgKgdJeMb+HOj0Ydupg5UTgUOOMmk1agLMOm87Dqh4FFh1t+044MYV1NUkCdnntqXAO1gzri9l0oP+bV5Gfo/3yedtJz9EYLg9Ek+xFfZKsunDpp1PRnzX1NuXiynZUfw1MzhM3gbMeJ7nptsfdsTGb/HhkmnXRYcRtuGAi46Xck7vsw1HNBxlG3XQ2EehTT9UZ5qSMwWBNyEdvaZ6QP4F93DMN58OR8Ant02G3hdNp3G0nwcMu9+ecEDVDmCfiG4S2juyUt5gi312wImNtuGA5l34kMLNzJXgVm21DQecOWAb2dLNPivpyL/gBvFOiAJxDvUtvo/HrbbjgA0iuHtMuzYdhtuGI6petQ0HVDoU3I4jbSMJrgT3bIVtOEAqDgdCLVy/5FlwtwPlnN7GmXKJwIpx0ulhD9mGAy6e482bxPJqNM42HHHCoeC6XNPuc4dtJKFRS9twQZl9DsiJANZy4zqy8ylJya/g7s8yUU3UOBDnUN8BQJM2tu2As/ttow76+KgM4ZdjG2wjKA6XJoR2N9tGElxZuMJZR3/78QC5ipt5qqsoacmv4AbxvY0ScQ/17TLeNhxwKkU1iWJHQSdC+TN8cOCpsM/hZ5fI1dHWtJPR0Uc5eb+4Wsc98rJtZEFzFdxMyJ/gSmawowWSGf/ICj6Ia0xMOSKJ1R1xardt1EGbWbbhAHGtOvak7QRAyhO5ovtbbCMFRQ69Q/Y5KDt/+ulgbmqtU7giKm8if4IbV1ewZMTWWt8HnDtq2w44nUJwZXNFik66IqhYnp0LVDqsP1bkY8mkuaNE+ML+OXwIWF2iLKBouxxA6gH5E9y4eyfUZm9M13H3SK5bhzTpaBtJ6OtQcGXD8tgvbScLNn7HNhyQWJ8Wl7B0tAHaDrJtB6wO8H4e/zWwzWcR0GR0chQqX0/Ij+CKZVFo5aTFUqpebDsx4cJSYMMDtuOIZmkEV6ooF02zHQe89GHgkizpZMjur2RfO68u0nkneOk60TYcIK+h7D7byYAjvwCWZvA310UjSUM52LQVX+RHcAtls6w2efPJTRHhlYzt9wBzHN74NfgpyNj/U7bhiEW3m8HDLyf+B3j1QdtxQNfr4Ssfcw1dp9iGI9Zx0JQ8IfDjT7uPr/09wHIHM41ujl9HPSAPgvt64QpuvrwVJPmPL9bTEn8SWEWB2PKIPeeYJj4EVyLjim+xHQdIHmUZPDa8ywpvXWGvFCMR2hW0sBe/255zxNVftQ2ftH+fqcHnElnPnTcA2PpRvtQf2fdBBmIe0pZz8rXnh/E6/W3iRwLT2eF6dD0h/OQ1J37HC54WSRB6cYTueI3tOMBVBjFhytNAy1LbSYHL5DVRolSyvqVxjRLES+XZa20nBzTrxD9jIHD+KFC1jf/fBfsFx8ja7eAnbCcDdnwW2EwRjCuynDBrBxtXmH7OKKzkNeELrlghQSzcdkOAiQ6jjMQCmF8EnD1k+wHp+4/AwF/YTgoKUXCLbwKG/a/t+GD73bS0H7WdmFIqvrD9TTsTcj3g5Bqx6ku+YTu5RLOFBeBY8OUE39Ud/MK3QNIsuiLh7nbRtOsbJRmWou/7iNuZSthc+xgfshBbQdI3dp5gOzFDlkNKvmg7SiaEK7iHHaxxljgqBOnFpYiLE3l9TEzebjDQPotd73ExLTnf/04KJo8gjHS4cRcmQ0RsfSwbKW8iXMHdEzB3QieZgrlO80ea3wC0cLgWFVef3CCM/DfbyJRWnJZvs+2Y0KOUgivWbUCaXM+p+VdsJyb0uInT8n+2HSVTQhTcHcCBgJnBSlwvJ3hw+bsTywrHTLs+0O+jQMu32k429KXoOkw3mEuGfAkY/rTtOKDkmzQkHOZXyCXth/K1F0jCqTwRnuC6yAzWPQfLCTW4XMcV4p5Y3S+yETHgp7YThC5GdF3nzXWJvNbeDqPTahi7Amga8cKTTdsBE6SclKZjDEJ4ghs0d0IiOimHiTKaTgXa9LEdBySq+hYwLXsCs5Y63vWl6I6fC/T5oO1HBHmt4/8rtzvcMzgjynTTMSykZt51knOhn+krWROO4F5aZaq7BqFnDq3bGorfbhsOSCQWSZXIJcYM+iwwhVaZhOk6h6I7+FfA9X81U9h8M/AevtaNtLwDhsH64WrOAod9zXYiwoBPAZPX0SDRqDIXhCO4+x2seXXJ4fptDT0dCq5QXmBWrght6S5ONH7ATqpS4A5odQunsLzRZRovFmbYiLV5wxKg7w/ZcVjiPR3FXzevuf1V9kSeSFi1fzbFSeGySkX9JhzBlfLcQUiEgYaQ6LjxBKCdw0xOB8XKjTHi6jXoblqbf6PQnrZC28t8LSxkGj+FIh+W8NYIrVibcj3kA3nNEzYYK99lzTk/9HgrMPEpU925tcOE8UqCcCLNyh8OFj47bW5myUGCUPV7YNG7bCcgqaJxdn3ZbXrAoLTqDXQcBXQazenzNUALSbsXQcumilaXBM9Iek9X4bpd+Vp7UFy6i8DQsoscG/mafwsc5kBQsYiv22GZ+IaN+HmPNO5exe/jiait054HZktWMgeEqSNJCC+09+RfeLNkUayv+8f4ELaT9XoOEj6s0wYNgNpvn5wT5HzaTRaf/48L5MZq1ApowqMxp8g1bXlGBNZKs+HiS8DR1ZxBrTHPfiqISP22ThxQ2tvBpZ34dkdRZFPwOmeMhyi8hxabChvnDpnQ9FSVG5p34yBaxIPP7SmwHUbwtfM9kJp2kaec/wImm5dBtVH+k+2En0tBUXLOWR7HeYgvdHMe4nLVjkd4Tjn5Q8LKJS+IHLLO7icpuhIWKriKoighUR+GfEVRlEiggqsoihISKriKoighoYKrKIoSEiq4iqIoIRF/LwXxSTy6CjixmccW4NI542faojuPK4COo/ksFU0VRVHyS0wF9yyw/wemHtaZchP33X44xXUk0KgFcL6S38LzZ/Yb5/DzJ4yT++DPA20dV2xVFEXxSfwE99BPgJWfNkmb+37UZ5mTDcDupyjQPwSatAMm/4FW8ET7NUVRlHCIl+CuLQWOrDCCmW26uD1fpf5+Cxj+daBHxFLhKUq9QqIBz/OQpOZt5ETBEx/BXdQXaDuIQvl/7AQtMV4BrLgVaNgUGB3TIoaKEjcqnwS2/8LsucgyX11IWsrus2gM3VyQOXjjIbgvDUOigOSAn9kTjtj+GX74a4Exi+wJRVGcs+NzvNcep4HTDLjyI0CXiUBrKaXU23w9gQhwOXBoAbDvL8D+50w6zqH38d7nzxQI0RfcDbebrFYDOTLmgg3v5Gh7FBgVsMBl3jkCvPJBGu8vps4aFZSmbYFuM3gjSJVeByWPDj8GbP4e77ccV+5t0po3+mRghCQUT5Eha/dXKBC81s4csCdihHjl9P1w8pSgobMVWDCVwsm/S6o6Z2qxlj1gUpg26wpcv8uejDfRF9yzc4GlH+AbzlGv0Th70jHLxwB97gC60uKNK/OL+F4dtJ2QKF3HhwCpHcu+Dqy733ZCojlv3mlJ3qfyh4A1X7KdGDOM72kxLcN8cuJ3wGIaS8O/CfQIWAp+Cy3cPfx9M19lp8SciykxWcMtA16YBAzm1KTr3facSw4Dzw8EpktKuxjGgpyeDSwMUqY8S2SZZ+xy28mUU8DsEEvXeCndyQfvdNYyO+jeQESQYqiTd9hOHjj1NxpJ7wNmLKLCjLAnAyK5j194W24NrxCIieAKl4AVFF3xuR38a3uuFiI8Uj+t6jVaMpzGDPik/6TDFT8GKjcA/f/TnogRNa5ygpQjGkarIldcPA0857ngS/fxge91ppyZw5vyPcC5o0C7IaasSy4Hu6XvBY7z8xVmUgiaSEULL2couJ4KFwnrPUZU832c65myl+bptq7me/sihXH6SnYcVsFOsAeYxxnVFN7nMXXrjJHgWmR6cZw3w1jxLrA3yDYK687f8L6/CejIEbVBY1NHTc6JQE+ez2/yMRWZ156jsriqxIyDPwBepvUvDPgE0O8/TDtXrJ4OHJD3lIz8DtA9i2m493dcy0Gu88dNO1esGM+JzDLTnjaPAzL//8s4QcGVJOWWfAlW1lzg39/Etkm+/n55n1vxXrvqf+wJx7y+BnhmFF+fVMSO3/JC/ObPA3/O2eD7gfmcEh77FbCA1lXTTrRaqvgh/7e5+Ys+b6zg0kq2Z1BIh/EHfZQslwKCh2Jo4XoJY/zsJbWvLDv+yzYy5MAC2yCdHdWQc4WUI4odDuucBeFaTv3FG0GENxc0GAmM4Wx0pecajBHxTF7T7R5arX+klfRFYBJH0pJkU+i2Zong2seAF66z51IgkWs7KeJKajr9o22Qyk18yHCz7uRf+WAHhrZStLCDaSsBuGSfScM839aDn+Cg/G5gYTE76bwLTvNYz0P2T3zS5S7znLiO4kU8BVdoMtlscslzOtreTpEYayrlpkLWew9nuwlUn2hgfClrOPCkbfhEdpxrKHmPbSjBkFpmlgYRsNDFKJr4W+D50WYT7TI489z5BWDJEGB2Kx6cgc7uaqxiqZrthzGcwa6lwRUz4iu4mSIly1/jVCQdUi4cMfTBDJs+H7ANsivJJmYy9nksE1nGURzgsXARkSUR2Zicvg5YdbcJqRcqHgHmDwCadaIgzzNrzYmDsyTZf1n0LmDLh833poT3qWQFfH217ceD+iO44CjaUCq4yq56CtoNBKpz7IRfCHT+oG0QidYTq8UPFzmDqD5l2k1lkyqmJdojxwX7TCK1Bn2FCVqoWEyhLQJ2c3YzbTdPy2yTX3sDWriy2VtaRSt3p4lOS0f/TwObJZAlPtQjwSVSk/9Sue0kQTwcXvdcvEoSOHiJH24NFT43zy5bTrjNNpTgeC3cCN7WoxcCV1Fkx1B4E6Xrk0GrdTQt351PcAxZas8lodMtQPlzthMP6pfgvs6LsmEr20lCA3lL8uRSEzf6vN82iLjg+WG3Z42upy4nuCNia7h1Ieu6vuDffw0t15fTfX9nirKEsXtee8SpX4Kb2FEfbNrJOHPQrA0p6el6h22QI+Lofta0k7IHOL3XNGXaq5U4HOKxcKMquJnQnoP5kVVspBHTjmP40l+2nehTfwRXotA6+4g6q1zPd0UyGcUJT0hqgzDDU9uZjY4aDqdZVjjwB9sgRTfYRgS55NJiOslDItzE9SmHx37PxmWzjrYRc9rL+r7kT0hB0/bAufgEK8Uv0ixbXqIwSImd9p7d9TdxAphbDMxMkqszqhyU6dc/mXYYkWZeDnwfWM33VRBXscQaXRJWjPu7293YnwOd/OxGOyLsSLOL/L8W3caBPs0mbS4ovhUY9hfbiTFyz46VtI6evYLarONr7f+p2MyW6oeFKykYm3dJI7bkOC/SbtNsR/FFkWcd99ASPiSLeKLV6PVx7hSx6DLXLLgxP2LbpA3F9ie2E3POVlChetpOEmRfJrHvEg8KWHA3mRwD87vyQ+HNPnKuPZ+CTQ/TOvRTIy1q5HOSwve33SDbJkeesI1aVHpi6ztIqHUhr5NTKKSQaZhI2kmZwc08wk4Pcy7WlAEXZKbZ3XSTcWIjX7uDvMwhEeMlhXJe1BRV2QhLlEjn89E1JvuUIGuLvd7Dz+tD7PBiTMt6YN4kYEbIN4oLvMlr+n88/Ixn+78NrP1X0+46BRjtyZNQw7p/4D1kAx6GP0BNuNe0wyKTJQXZ0LsxiGsgr8XZQ0yzVa+CSZ4dKvu+AZzanb7Ki6TUjFGioRhZuHv4IXzL3DjyJi8cC2x+xEzbOo8DRjwETF/IN58fknwA4yi+3f+ZP+dHbMnKT/LD9eu2olzGFZ6lmgrJ4lbHDVD+rG2QHup/q6RiA/Dqd3g/pkszSuu2bX/bjgcxEFxaC6uuB+ZeDZzZD1xDa04EdQoFWDYGej3IKe37aKuP4vfKrmYWKdvOPm+Eu4SWl5IFxSbpdQJ+Nsdrhfqenw9cPGfaieiyNK55Sv2l4lHe6zSgrpNNvyJzLhnb/h3oHa9cHNEW3K0fBZa8gyPdXcZzoN9PcpPtfeXHOO1LsbuupKePLN1YagdBSDhnDZJFSqnnSGn0dSa96oGHOXOlJfvKW4Hnu5hln5kvA81nmm9NhdSeK85xHmXHRFRwKa5SFr15d2CiTBtyuKMt1vM1ktQmzhsN+fLD9VDsWVYor7VBucfjf9sr08+ywj6HiEs/3HynSsw3UhpHEtZsugNYfq1ZDpzfk/fdPcCup4znioTTD/wnk/1viGSeG2h+NhXijtjuKja8+RiiTwSvhipgAd/woV/nFD+X1UcvGLHt/V6gZak9F4Bdsl4cU6r+CGx8P3B2nj2RDX08ywrkxG9tYwtwTnbOLU0zcLtbOpQ3aDdgYbwLB9Y7pCrDBg6sIq7iHy4VkHvQgh1LMZXlQCniKRurI+cAV3P2c8W/0LiaYX/YJ+vu5e+rucbiQ/QEdwlHwVHfM6F9ueLknynqvIkHfQ5OSru8ymny0VXA3DbG4T106tik8s1p46C/izfDfJnGBdhR78XBq4aaZYUyjztY8c224YNdvAlrapBJOHDM0vC9waUgn03cqDTeKC/y6DKB4noSuJb3g+yzSE5qONrg2kERl3Lw4Cw4ZkRLcFdNBfp9wmyC5YKqPwHLRpk1xamvAq1vtV8IwHmO1Afnc5DgMfMoLcV/40V3i/1iWAT4GE89bxuWDQGSOpd4civse9o8X7acIDedT2R9zktlmhDPSOHZ7DnFAWzNDdkf2z4ZcOYREkd+Djx/JSc6vHev3w10+yxPpkkUlQ2n/w84wPej76P2RLyIjuBuvRNowg/Id0YhP5TzQviZGXVf6EUr9GVgHKcxUvvMVVmXJbzAxtdsEjUBhnJ6Lu5lUl7kVFglQAJYUdXHbMPiFciMGQC09EQGiRvfcYn1t7Tzu35Ly/ZsBiVXIgevLSleWoOsaWd7bP1PM/Moi7AHTdl9wOaHgellfN05zAAn6RoljHyC55rKGm86y/CIiODyxW/7Kaf3mRae22RKcojjvXg0rL3RWAWrpwErOKVZfxe//prxcpBRtxcFQFK6uWL73UCn0UAL/p9exKl+Ci++iheB5WN4Quo2xQhJ9JMtsiZewys2y7/Q8Ro+eKrKpmJP/Nbm3sTkhbZ6iCM2PWQbEaPix/y8/mw2t9HCnMsF+x/kDJj38aQt9kQA5Pqe3cj87SEToUizHbQKrzO5DKQIXVKqgC20ILf/kjfxSBoTw2k5DQVa9+EhBQllh7Np4jtzC0fZuRwgZBkh5f/HC2TBVJOEo+VN9pxjgiSvOc73eqmneoMgeW6l6nFW8H2RGlW1GcFBUTZH/CCzkVN7bMcygX9nulwYqQg7ec0bcOBFrVmEXy6dA56VAdtSKt4TEVoFPPMsDZwv8LOxa+25QJbsVn4K6DKJ1zaNMhdIuP+k3wEHngd28jq/Xq6LND6/jojQp3elsQrP7DPuIwlfvdq8AszpBjRqaS6+cauprxTeos9RbN/Gr0vgQxhiSxbx/xv1CBvp/j/+ved5w7X0pDGMOnv/aBvZwM+gWR2ziCv8TjUptLXFNtZI5Vq5LrM4GnL2dBnp8g2HCS3aJe+m2NYRxh0YGl8Srr54gDGspPaZK7F97eNA91m8bacYL6jrl1BvbgF2f8V+Q26JkOBaRnHUkXj858Uv1rNR8vpaYN71wHR+wP1kKpDHP10ctUVU/KQXXHUrcJVYdnLj5Yogvrd1/OyFM0C1hOhmibfApNBCEpD43FEuL4DlhPrAwhuA0WJwdDH9jJGcJXJ/c0Yka7OHOQPcxOtmXgfOuHjPNGxBK3Srne068pEXTxfZML9s9sbfPXaFyXnxfCf2c7s5mz/VevV245VQF30e4pvAEW0Op1PHZUPqIN8MivCUp00p83wjO+gJEUlD5VM0SvZTa++zJ3JFkOlvkp/dmWHpcy9X1vJJlixWftktG5pK5Ol6HbBW1uj9zEY4wyv7OieoNwEv9Db+uYtGAmv+iRYshfYohVDWuwc/AMzg98qmWJdP2J91yIuclV6bJLFT5zvNpt+6Lxuf9ByRH8Hd/x2T5UsqMCySddc6oola/wNwA6ctsvEybyA/jC8CjSfaL+aZyZzytBkEzO8GnEyR6HkFL5pJYSSCDiC4kk+0LvZ4ao9lTBHfI1oSrUqA/ryQi/wK7klbAdiSSOOoRJIhNCaG8J6cw/tAXLWSIT6zszsC54+bgff6l836uNxDEvgg7l1dP203nj2BM67Zcy/vWWpNwh84GbSqh/0NOPKS0agcEL7gik/hxu9yFOM0ojdf1Kgf0HodnCRggKOepLYbej8t/3DWWHzT+9vAtOUcEb/GkVqiZKSUioeN7+X1I36pEn4YIpnugXqTN/fwbOrJDXJJ6pRlibgHiWdI/8fsCR8c9ljV4v2R2ATNA5EqMx5hun4GmLkYWPqBut3W1r/DWK+lvJau5H3eVGa0Mm0PG1qum6g5o3zsTYg/ccNm/jd4MyRkwd1Hs/5Wsw5bk4C61c3sU7hefDtwKIm5n3CijiIcECasA7q/hVZ4sYkZF6p5EYpzdmKtOUY0bonLkstI9FmY7PIsJ0guYyU6yOBbl1EkWfpmUND2/sksGdSw6UMc/C8Ao2UvwOP9kQ+WUWMGSUBPe9NPynlg9T3AxCCbxqkJUXA5dZUctiMf5odUe8eelsxUfmg7OLps/Zg9FzFkowxJnPFlyjxjO6ct/KCkDtPS91GIY7oW6fWjDbKOmzG8PsRvuYYizSoWHSpNyaCFb+UtUJfLYStg/FpasB2BxQN5H9NAOkyjY1hYgT9pGMT7c9vj6ZcJ1t0G9BX9yV360PAEd/k4oMvkFIvh/FPGchS9cBpYGZG12hrEUVqWQWZ3rXvqlIBTJRnNB3GELJpWh59nTJAZR82U+txhPuTQx9JLpXgn2OWQNlIyJV5ZoAqaxaOBq7/Gmegu4LWfJDeKxKNA8pNs/hEwWerbRQTJyzJ9PweBpcbVTFzaaiM+xVKWXZY+ckg4givuHnIzJUJq0yDp2Sp5k0uezEhAy0ss1ms5QpZSgCoWGsd8cciuiw7/aHyD44J306xm/fcKWjI17H7KNnLMbo87WK8c5dJQMkeiNztQcBMh9204c5Ow64rkRpEkg0oEjXQz/cjQxGyIXfMIMJ8G0bZP2/OWl+7gIBEkrN0fIQjueZM5arTPZBNrZxlL2PfOdo4RF5F2V/OQNUVasZKkRrKZyZrzegm2OJP4tvzi8aXNNB+ud9Os5md7ewTPu66aS8r+1zZISZ4F11k+3H1mX0KMh2yPywhvQppAMradLnuzoSRLBcW89sXwEJfNONGCA8i0A/yMqUvzi/j6njYh+hIM0XiC/abcEVJobzWwgB+OjCCpXpREe+z9HTDpNXsiz0jSZJmGTJa/p7aQ8W3b9EETGjiaU6iu/NDyhavQXkkOfpVNpyi+kjWU7uRDb9POBbJkI+uDgvg3T+X0T5BdbtmMESbELLT3IK+Jlx1v9joLN/aB5ChZficwYy87SSosS8CCpGKc/EcakDSSosS89kCPm4HB/8VOsoFqHQeNWyhPlcb/NwRCGjJpzstNtOEBoJzWYV2cmWPWhyYFcEVyAv9OKf0haRwTYit+oXVZjTwna1Y3LKbw0hJZHoGADJd09ySE3pfjzTNvsEPGFSEiimuxHZIbN6W62QAseS8wXVJ3pihnL8bTNH6viG7tOnb5RJKfdxoDNGpmIteS/m3DjNvpjOW2n3vCnaOMeNaMJhtqx9Vz2iK5CWbILnU6140cIOuxO/8ZWNyfVk4P/n3fBPpydJ+8jV9MccEJEozRbjBwpScXbOjUNSD4xfuznvZlywo5Ftya8umC9/+NLbUyWnWfmf0hiYSu+zPfl2/bX5ZrONWWqM7RNH4ShVnTUL3JbHS3z6CSRy45O9cE7Yz8C2d7P+OgsdAYeomsfXI/14VspIVDyItCRBJG9OEUdunV7Nj1z4XjgDH8gGXECYWtSNREkjSOMnWex+fKVzgV53S8dLsRWr+hhVKe5hynI13usifyQR0bX3553bNe6d1A6+DJICZRgblaqxOf5eoq0xY/4Iae7Fj5InDgg+d9lBh9iajK9pC4f4m6DI2mNDY+aqKt0sJrYkEprURZf49CTcDd1BUOUBNkGcEmP28w0ixRFvM9nE2DavtnzPk8Eb7gCq1u4ptCa/f5nmYqXnIbb3BP1decQEHd8mFgbltg/iRTEkdSQd64wqyNjXjObtSJS5JfOLKvoCU8lhZIwcGByJuf+ECOrNzLlhMyqAih5A6JAO1xq7UKPYNHbV6goTT0a5nXI8sFUop/Lo24QZ+ltV3HbFMiVUvLed+voe50AU7mx0c4P4KboJjm/mG+OVdR435oz+WCV82FM3sEEtUHxv0KmFZhYsF7fDWYRbWSU77BX2CjQH1GpVxKDVJhNRd4czZodFl0EKt6LD+bBZLlro6p+OrpHJCvBbp/yZ7IA6doWb/Ka0YEdNG7gFE/4q34ZfvFuijiTJozKvFIyFNC9zwKrmVgrdpVLtnFi2E2R70GnCKWUmwlsKLN2+0XAyIL842ap/mAY04XT/pJKU/k3AWOn0lNKR3Z4GjOAUyJEL3NZvciCpSIWw3iTSRBMTUeLWEhKVol8GjZaLMUKB4Gl87yvn7cGG9+0qWKx1T5MxTeIMmZsif/gpsrxA1Iwvkm8aKQyqGQNWNHrON06zw/YMndW9C0QKKiRg2HJTepQ7zLCVc4KFWv5IbJ22m8/MYYMFLxevvPgfFheBMdM37MUpRVBPaZkUhUaehNq7b0FbMUOJR/T6L4gE/W386B4l/ZyM+stDAFV5JoSHkS8a1r69LNaB2w5CqgSVsTAFEfuCy3Qk2xTEfs9Ai43ERKdBFrthmn7ksoWNNkQy2HlVUk+b1k4JO0jps59ZfIx9IyI7ASPp/Ya8lig11ya1dty2tQVeEJrvjcSWlqKb/jjE1GxGfT2ruKo3zW9b5iSHdPMuZDi/ngyvl+N3B6n23TeslltVfFDd2/AMySSg25ylt7GljLmc7cKWzzmphBa1by5kq4cGAvCFrEkkZygg2kyRMRKiLpAr4U8UKYKdExDvx5ZUTc8ihHxc1IlD4vkcoNEcyV6o1qyjjSjIPHUrurK14CV9VR4kYyQJ3YatoT+Z60c+ArW07LZY3dcJEgi5FzTdtLbCPN+F7NlmKmFvGnDQPZU2hPo6BEBCqXJZ1ygPjCS0UGKV017peOI9fWA/MmAZP+kPd9gsISXEm0Ufx2joh32hOZUMWpDEfBgxxVy+cAl6p5o/D39eB0JgplfVKRi9BeL7JRsc6WCbpilglgCcqykX+v7jD+FybpT21iK7jn+bua2XaeKJWMWLlLM+gWCqJUeh7O66zHvfacI6p4/SzntXXdX03hyDxTQEsKR/jv5QzFlpaIlACR4nGzaRm/+iDQgpbBGAquFJYr4QUQdbFNEEAc6soWVptizzru/udsIwi1S+kUmv9tU4rHN2w7T2yLS/L7i8CccUiUZHIqtrs4g7qBRtgXgRlrIiG2QuFYuGINSfy0n9IYZygar/D7JMLpSo5+skMuESlxJdcWrrCwBDgtSzVEkpUEca+TneeVnzTtTtdycEsSyx7n5DVvIFVgUwQPuKSM79W6+01bljEkUi3qSMJ+KUVV9Dl7IiASubjxO8C+p4EhXzJBHBGicCxcuTGv8PGhradQrONIOu5JE8IrEShxFtsEHnHIOLTXh4UreL0IxEUoCF53sN4RrOzgtKaZ1LQbGs7RyTMbu3jeNiKMpEZs3Ca42F7kgC3LXguuoEVLkZUIUhkwIya2QmEIrtSbbzeIjTSuKtvEquIHIcsFGJI4pfjE6x62f7ZtZAMFvmKRbZNu6g5Wb1nG2eWYTEPGL5pCj1vvNGkBJMpsxy852IwzQRpjlrizlnNAYQjugblmgyslZ/khcSo7NIeRbQXNcLODLFw8R+skS9F9UymdItNW6hdHfmaDakpMPx2SK0ECjmY3Nv7gbQbQcOK9PP0Q0J/3daLMevQpDME9tYcWbppy5Mf/AHS9no0Opq9kjnf6n21uBW8pnUQZeaVesvHbwNXW8yUlW4Glw4BX+f2y35IIflhAA0tymKS55yNIYQju+eNA0zSlmKU+vmzQKNnjXVYoyzJDmnc5oliXE+onp4CqHUCTSbafjHXAAhpJox42ftqhpqnMDYUhuNUn+OGlsVwvnuYHJjWYlKxpNN7krBUk6bSEYGaCbJLU1Atr3oUP4SV+ViJE1XP+gkFeuBkYQcu2gJIaFYbgigics1mnkiFx4Cd3246SNd6ctTsz3PDwFqTs7QkZVuoXR1YC3dL4xcpGuOwV5DxPdrgUhuC27stZihQ6TIFUApYS50owvCXM92SYns+7DKHJauov1UdpAKUpo35gHkV5qu0UDgUiuP04TdluO0mQXUzZXJNFeL8c/AEfzpq2YpCAAcldK5w/AVzymaZPHNJlGUKQ9fYolNJR8oNcN03TLAHKvdpptO0UDoUhuJ04PfEWIkzG8G8BK3zujB/+KbDhQWBOJ+PCEmWae6yFCwEGiAY+L4diT/7RzT+yjTQkMo1ZSnxmBqsRdhd4l5yad7cNLx4f7pp15rhx3lPq22nwhmMunuG11sB2ktCQn4d8X4FROKG9L/QGJv+BH1SaUVGSKO/mVDhR+E4idOpA8iuI+9LUDewcB5bdxpu/FTBGwky7Jr4lWuwEZmdSiy0Jg/i6r/y+7aTg/EJgXoDp3lvW8MobYTspkMoCkt/CNcnCdiXJdaEw4C6gX0TzKUghR1kG7JailLwYPBUvAEMCRjVGjMKwcIW+HwS2+LC2en/XFJqbO4E387uByic5kkos/3pasr8AFlG4qimyU8t5jtYteGGMo0DImuNctiWtYOTow3HAQXKOknfYRhokEUjPLHMpDLvfn9gKvbLJ+paGUd+zjTqQ2PtCoZ9UNYgoIrYnd9hOEjpzFpSt62GEKaD0jJwGShRKqXgi+IxeqXjULM7XTF2kpPUASQKTLOz3JPAKhVc26CbIxdDfnI4K2+8B9tNyr0qzgVgXUnak17dsxycyWxC/2uMyE0hDh2FAj5v50XzTnvDLLr7ntNZkZ7um/lmmNGkDtOf/LwU/0/lySn7gLbQMj0j4d8yQ19llPDDicXYi7AJ5lvfc+vtMGG4qxCCSytHdeF2n5QIwv9j4ivuZpeWJAhJcsudeU+xwRJBYfx+IP+myj/CD/RA/4OglyFCUyCPLN6U0YNDK9OukElgw2Mw8UoruKd6Pk/g908xm22HOWCf9FmjMWWzEKJwlBaHkG8YSkvR/uaTlW4FmnfxPwRVFuRxZkqr4ue0kox0wdROw8SFgNcUUZea0l8r/BuaJZft+oM/DwNW/B8bx9y56J7ApeqHjhWXhJlgPPDsSmEXhzVXaRUls3LInMDDdBaMoSp1ISZ0lnP4n9kp8sP9BI7wNmwFt+ptgp+O819sPBUb+it9QRxXeHZ8Ddv4aGPszoPWt9mR+KUDBJQe+T929H5g+jx+Q4/wJG3mRlM81WYoURcme5bw3Zc01lbfCmxB/e+vPndirSZNDBVuApbcBrXoDw3/HfgtzOk8UpuAKFT/mNIQf5ISn3JVKXzkZOFcBTNrMTgG5EClKPri4DJjP2eJMCUhyUPQ1FaunU2t7AIOfsCfyQ2Gt4Xrp+mngRo6Gyz9Mq1TCUQM4s5/8M7CoL9C8K8WWI6aKraIEp9E4oJhT/aUuK/TWgeTSPbQk72IrFK7gJujF0fMk0JJTjzltjRsTNpkv+UGcr0VoX/kqMOZxYOgf7RcURXHC4F+b5w0+ow8zhkbXPFq3s1bbfn4p3CWFN3GWWvsxky1ePAy6Xgd0mWjWdsT/VhbjL54Cjq0D9v2Vx2ygRynQ/1PGK0FRlBzB+27BAKDdQGAUrVFXXFgKzJ9p3MqKv2ZP5pd6JLgeqn5P63WlcSE7tdsEMojotr8aaDvIRG21usl+s6IooSB7JOePAhOl2nAPcy5bJGp0+UeCV3t2TP0UXEVRoolE+i29w0Y+SlRihvslVX8CXvky0Kg5MF68Emg1RwgVXEVRoseG24E9FExZ1iu5DegguUL6mK+9iU3Arl+Z6r2yXDjye5FdBlTBVRQlolQD279gUq/K0p9Qs+fSqKnJr1y53qQnLXk3D0lqP9h8X0RRwVUUJSZsBM7uA84dBJp2AVrIcgEFOEao4CqKooREgfvhKoqiRAcVXEVRlJBQwVUURQkJFVxFUZSQUMFVFEUJCRVcRVGUkFDBVRRFCQkVXEVRlJBQwVUURQkJFVxFUZSQUMFVFEUJCRVcRVGUkFDBVRRFCQkVXEVRlJBQwVUURQkF4P8B1bSGRuZZwVwAAAAASUVORK5CYII=' class='img-fluid man' alt='...'>
    </div>
  </div>
  <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center mx-auto' style='max-width: 25%;'>
    <p>".$portfolio['por_sobre_mi']."</p>
  </div>
</section>
<!--------------------------------------------------------------- Proyectos ----------------------------------------------------------------------->


<section class='container seccion-proyectos pt-2 pb-5' id='ancla-proyectos'>
  <p class='h2 text-center mt-5 mb-5'>Proyectos</p>
<div class='proyectos row column-gap-3 justify-content-center'>";

  for($i=0;$i<sizeof($projects);$i++){
    echo "<div class='card' style='width: 18rem;'>
    <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAXcAAAF3CAYAAABewAv+AAAACXBIWXMAAAsTAAALEwEAmpwYAAAAO3RFWHRDb21tZW50AHhyOmQ6REFGX0dKajdGdlU6NSxqOjc5NTE1MjYzNjYxOTUxMzY5MTEsdDoyNDAzMTAwOcaHQYoAAAT2aVRYdFhNTDpjb20uYWRvYmUueG1wAAAAAAA8eDp4bXBtZXRhIHhtbG5zOng9J2Fkb2JlOm5zOm1ldGEvJz4KICAgICAgICA8cmRmOlJERiB4bWxuczpyZGY9J2h0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMnPgoKICAgICAgICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0nJwogICAgICAgIHhtbG5zOmRjPSdodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyc+CiAgICAgICAgPGRjOnRpdGxlPgogICAgICAgIDxyZGY6QWx0PgogICAgICAgIDxyZGY6bGkgeG1sOmxhbmc9J3gtZGVmYXVsdCc+RGlzZcOxbyBzaW4gdMOtdHVsbyAtIDE8L3JkZjpsaT4KICAgICAgICA8L3JkZjpBbHQ+CiAgICAgICAgPC9kYzp0aXRsZT4KICAgICAgICA8L3JkZjpEZXNjcmlwdGlvbj4KCiAgICAgICAgPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9JycKICAgICAgICB4bWxuczpBdHRyaWI9J2h0dHA6Ly9ucy5hdHRyaWJ1dGlvbi5jb20vYWRzLzEuMC8nPgogICAgICAgIDxBdHRyaWI6QWRzPgogICAgICAgIDxyZGY6U2VxPgogICAgICAgIDxyZGY6bGkgcmRmOnBhcnNlVHlwZT0nUmVzb3VyY2UnPgogICAgICAgIDxBdHRyaWI6Q3JlYXRlZD4yMDI0LTAzLTEwPC9BdHRyaWI6Q3JlYXRlZD4KICAgICAgICA8QXR0cmliOkV4dElkPmVhNjA4ZTAwLWYyZjQtNDAxNy1hMGZkLTg2ZTJlZWZmNzdjOTwvQXR0cmliOkV4dElkPgogICAgICAgIDxBdHRyaWI6RmJJZD41MjUyNjU5MTQxNzk1ODA8L0F0dHJpYjpGYklkPgogICAgICAgIDxBdHRyaWI6VG91Y2hUeXBlPjI8L0F0dHJpYjpUb3VjaFR5cGU+CiAgICAgICAgPC9yZGY6bGk+CiAgICAgICAgPC9yZGY6U2VxPgogICAgICAgIDwvQXR0cmliOkFkcz4KICAgICAgICA8L3JkZjpEZXNjcmlwdGlvbj4KCiAgICAgICAgPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9JycKICAgICAgICB4bWxuczpwZGY9J2h0dHA6Ly9ucy5hZG9iZS5jb20vcGRmLzEuMy8nPgogICAgICAgIDxwZGY6QXV0aG9yPnhldmkgZmVycm8gcm9kcmlndWV6PC9wZGY6QXV0aG9yPgogICAgICAgIDwvcmRmOkRlc2NyaXB0aW9uPgoKICAgICAgICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0nJwogICAgICAgIHhtbG5zOnhtcD0naHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyc+CiAgICAgICAgPHhtcDpDcmVhdG9yVG9vbD5DYW52YTwveG1wOkNyZWF0b3JUb29sPgogICAgICAgIDwvcmRmOkRlc2NyaXB0aW9uPgogICAgICAgIAogICAgICAgIDwvcmRmOlJERj4KICAgICAgICA8L3g6eG1wbWV0YT72TK02AAASKUlEQVR4nOzdPW9UVx7A4cMqduOVbDemcQS4IcUiWGhIgx1lm02xZqVss43NJ4B8ApxPgPMJMjRpY9Jss2idVG5gHbEFNMaR3JBmZqW4mS28xdGIBDz23Ld5+c/zSFGCMmOfWMpvjs8999wLJycnJwmAUH436gEAUD9xBwhI3AECEneAgMQdICBxBwhI3AECEneAgMQdICBxBwhI3AECEneAgMQdICBxBwhI3AECEneAgMQdICBxBwhI3AECEneAgMQdICBxBwhI3AECEneAgMQdICBxBwhI3AECEneAgMQdICBxBwhI3AECEneAgMQdICBxBwhI3AECEneAgMQdICBxBwhI3AECEneAgMQdICBxBwhI3AECEneAgMQdICBxBwhI3AECEneAgMQdICBxBwhI3AECEneAgMQdICBxBwhI3AECEneAgMQdICBxBwhI3AECEneAgMQdICBxBwhI3AECEneAgMQdICBxBwhI3AECEneAgMQdICBxBwhI3AECEneAgMQd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n3f8v9DuTvH3IOxMYOROdV2Hva97TlLnJa+qRuOIkbAzmTl3Zs+QDss+f6vvJ4BDiTuz59yAgjqkZ4F9xJ3Zs7jWz3TIQXMXxJ3BEndmz2gccfle308RsbTe9xPAkayWYXY9WY344W/93NvafgbOyJ3ZtbJZf+/zKuavRFzd6P6+UIK4M7uaOtyijHM3i3uOxt3dEyoQd2bbaBxx40XE0oN2v2Q9daa4x8qmsDMTzLmTx+5OxMv1iB+2It5928w1569EXFwrVuiIOjNE3Mnpv/8p/tTxi18Vf2AGiTtAQubcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSEjcARISd4CExB0gIXEHSOh/dAbKY05AHbkAAAAASUVORK5CYII='>
    <div class='card-body'>
      <h5 class='card-title'>".$projects[$i]['pro_titulo']."</h5>
      <p class='card-text'>".$projects[$i]['pro_descripcion']."</p>
      <a href='".$projects[$i]['pro_enlace']."' class='btn btnproject'>Link</a>
    </div>
  </div>";
  }     
 echo " </div>
</div>
</section>
<!--------------------------------------------------------------- Habilidades ----------------------------------------------------------------------->

<section class='container skills pt-2 pb-5' id='ancla-skills'>
  <p class='h2 text-center mt-5 mb-5'>Skills</p>
  <div class='skill row column-gap-3 justify-content-center'>";
  
  $arraySkills = explode(',', $portfolio['por_skills'] );
  foreach ($arraySkills as $x) {
    echo "<div class='card' style='width: 14rem; background-color:orange; text-align:center;'>
    <div class='card-body'>
      <h4 class='card-title'>$x</h4>
    </div>
  </div>";
  }
 echo     "</div>
  </div>
</div>
</section>
<!-----------------------------------------------------------------------Footer----------------------------------------------------------------------------->

<footer class='bg-body-tertiary container text-center text-lg-start mt-5'>
  <!-- Copyright -->
  <div class='text-center p-3' style='background-color: rgba(0, 0, 0, 0.05);'>
    © 2024 Copyright:
    <a class='text-body' href='#'>Portfolio Creator</a>
  </div>
  <!-- Copyright -->
  <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz' crossorigin='anonymous'></script>
</footer>

<!--Div container principal --> 

</div>
</body>
</html>";

    
?>
<script>
document.getElementById('descargarPortfolio').addEventListener('click', function() {
    // Contenido CSS directamente incluido como una cadena
    const estilosIncrustados = `
<style>
body {
    font-family: "Kanit", sans-serif;
}

/* Contenedor de todo el body */

.contenedor-principal {
    background-color: white;

}

/* Barra de navegacion */

.navbar {
    background-color: white;
}

/* Seccion principal */

.principal {
    background-color: rgb(247, 247, 247);
    align-items: center;
    height: 400px;

}

.nombre {
    font-family: "Kanit", sans-serif;
    font-weight: 500;
    font-style: bold;
    color: #ffa500;

}

.saludo {
    font-family: "Kanit", sans-serif;
    font-weight: 500;
    font-style: bold;
}

.man {
    max-height: 350px;
    filter: brightness(1.1);
    mix-blend-mode: multiply;
    padding-top: 30px;
}

.bi {
    font-size: 30px;
    margin-right: 6px;
}

.card {
    margin-top: 5px;
}


@media (max-width: 766px) {

    .principal {
        height: 100%;
    }

    .titulos {
        text-align: center;
    }
}

/*Proyectos*/

.seccion-proyectos {
    background-color: rgb(247, 247, 247);
}

.excluir {
    display: none
}

.btn {
    background-color: orange;
}

#btnOrange{
  background-color: orange;
}

#anchoDiv{
  max-width: 200px;
}

</style>
`;

    // URL de las hojas de estilo externas
    const estilosExternos = `
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link
    href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
${estilosIncrustados}
`;

    const html = `
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    ${estilosExternos}
    <title>Portfolio Descargable</title>
</head>

<body>
    ${document.body.innerHTML}
</body>

</html>
`;

    const blob = new Blob([html], {
        type: 'text/html'
    });
    const enlace = document.createElement('a');
    enlace.href = URL.createObjectURL(blob);
    enlace.download = 'portfolio.html';
    document.body.appendChild(enlace);
    enlace.click();
    document.body.removeChild(enlace);
});
</script>

<?php
/* Convertir PDF a base64 */
function convertImageToBase64($url) {
  $imageContent = file_get_contents($url);

  if ($imageContent === FALSE) {
    return "No se pudo obtener la imagen.";
  }
  $base64 = base64_encode($imageContent);
  return $base64;
}
?>

<script>
function downloadPDF(base64Img) {
    const {
        jsPDF
    } = window.jspdf;
    const doc = new jsPDF();

    doc.addImage(base64Img, 'JPEG', 10, 10, 120, 90);

    // Guarda el documento
    doc.save('CV.pdf');
}
</script>