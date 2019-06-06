<?php
defined('SECRET_KEY') or die('No direct access allowed.');
?>
<div id="container">
    <?php
    if (isset($_SESSION['error_login']) && $_SESSION['error_login'] !== NULL) {
        ?>
        <div id="error_user">
            ERROR <br>
            Не існує користувача з e-mail <b>"<?php echo $_SESSION['error_login']?>"</b>, або не вірний пароль!
        </div>
        <?php
    }
    if (isset($_SESSION['error_activation']) && $_SESSION['error_activation'] !== NULL) {
        ?>
        <div id="error_user">
            ERROR <br>
            Користувач з e-mail <b>"<?php echo $_SESSION['error_activation']?>"</b> не активований!
        </div>
        <?php
    }
    if (!(isset($_SESSION['email'])) || $_SESSION['email'] == NULL) {
    ?>
    <div id="main_container">
        <form action="account/auth" method="post" id="form_login">
            <label for="email">E-mail: </label><input type="email" name="email" id="email" required><br>
            <label for="password">Password: </label><input type="password" name="password" id="password" required><br>
            <input type="submit"  name="submit" value="Login"/>
            <p class="regtext"><a href= "create">Not register yet?</a></p>
            <p class="regtext"><a href= "sendpassword">Forget your password?</a></p>
        </form>
    </div>
        <?php
    }
    else {
        ?>
        <div id="main_container">
            <h1>My account</h1>
            <p>Username: <?php echo $_SESSION['login']?>
<!--                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAACKgAAAioBtyI5mwAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAANUSURBVEiJ7ZZNaFxVFIC/897MlEboD/4iQaVMk5lMXlBHO3l0mkbUjRsLGhdiQd002EXB30VLoUXQBjfqSgi2qy4UXXQj/lSH0kxGREzzZjIzoYrEEqwYsBSNmXnvHReZSd8kUzMzURH0rO45957znXvOve8++K+JbDSAZaW3u3jvKzpXcnLPtuoX2ii4Km5aVPaA/NKOX8dgy0pv99Tf7yEfi+n2m77E/xGwi3cS4VFDtYprjhXy2SPt+HfU45hl7xXIBExedXHbDRcvfrTUagyjberIiAn6ZtCkMN4OFNosdTSa2hIpX7pf4TRijIZUyp76+1X0i3biwDqlTiTSd/imNyzKbuAhhVv9kNFT/mZivr4m3m+PIRxAOFqcnnwb8DcE7rPsYwpHaGiHjBWd7Ct1LTqQ6g6rMQtsrpnOmioH8vnst+uBm/Y4kbCjCodXzS9sMiOvBdeFVI4HoAAPeqJO3Bp8eXh4+E/b2BSshhwGzAajyNGpqczKRyJmpZKCPN3EfTPIics/L830JnY/0DI4OpDqVvTJgOlHFX3L8K6Mr3J9lVqrFL0A/N6YKDsNw/+kb2DwjWQy2bUuOOwbLwKR5YByprro95amc4cKhUJlJbloaosBc0Ae+Kzk5O4F/bzJxkKq8sJvlcivccvWuGXrtbyCu71nz81h1/0e6ALm/YoRC4f1Fk/0XVT6EJ1ROAvy6W03Rr7KZDIuQNyy9wEfNNvIaik6kwKr7nG46h1C6AJQ4XS5PHE1btlngCFEAYYEhkCPXV5YuhK3BidExVR4uBVoQynqgx3J5FYqenBlRmW2Ntp1Hd+tII9ohw/rSpaRpchzwLa6LsqdteHXnYVuESzCwcYpfQIwDN98CmHqbwOvEWFnvN9+vVA4/0Oxt/s+gVGFn/5ysCqjwLzCJWC6Bn8pZtnv9RfnbppxJt+pRCo9IGNAWy9RM1lzNGJ3D94lnpSATdeS0sdK+dyHdb3HSu8w8E4IPN4usH6d1pRafNkXhALnglCAWef8dyVncgRkL0hHh29tj31ZCGhVxX/+es5FJ3uu6GR3KfoMy+1p6UmEZj8Cwu3LA80JHC86X663I7/k5E4Bp1qFNgVr1R03QqFFr2qcLJcnrrYT7H/5V8of4KEtLUuTJiAAAAAASUVORK5CYII=" class="edit">-->
                <br>
            </p>
            <p>E-mail: <?php echo $_SESSION['email']?></p>
            <p class="regtext"><a href = "change-data">&#9998; Do you want to change your data?</a></p>
            <h2>My photos</h2>
            <?php
                require_once 'app/model/showUserPhoto.php';
                showUserPhotos($_SESSION['email']);
            ?>
        </div>
        <?php
    }
    ?>
</div>