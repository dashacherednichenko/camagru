<div id="container">
    <div id="main_container">
    <?php
    //session_start();
    if (!(isset($_SESSION['email'])) || $_SESSION['email'] == NULL) {
        ?>
        <div id="error_user">
            ERROR <br>
            <a href="account">Увійдіть в свій обіковий запис</a>, або <a href="create">зереєструйтесь</a>!
        </div>
        <?php
    }
    else {
        ?>
            <form action="" method="post" id="form_register">
                <label for="email">E-mail: </label>
                <input type="email" name="email" id="email" required value="<?php echo $_SESSION['email']?>"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAACKgAAAioBtyI5mwAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAANUSURBVEiJ7ZZNaFxVFIC/897MlEboD/4iQaVMk5lMXlBHO3l0mkbUjRsLGhdiQd002EXB30VLoUXQBjfqSgi2qy4UXXQj/lSH0kxGREzzZjIzoYrEEqwYsBSNmXnvHReZSd8kUzMzURH0rO45957znXvOve8++K+JbDSAZaW3u3jvKzpXcnLPtuoX2ii4Km5aVPaA/NKOX8dgy0pv99Tf7yEfi+n2m77E/xGwi3cS4VFDtYprjhXy2SPt+HfU45hl7xXIBExedXHbDRcvfrTUagyjberIiAn6ZtCkMN4OFNosdTSa2hIpX7pf4TRijIZUyp76+1X0i3biwDqlTiTSd/imNyzKbuAhhVv9kNFT/mZivr4m3m+PIRxAOFqcnnwb8DcE7rPsYwpHaGiHjBWd7Ct1LTqQ6g6rMQtsrpnOmioH8vnst+uBm/Y4kbCjCodXzS9sMiOvBdeFVI4HoAAPeqJO3Bp8eXh4+E/b2BSshhwGzAajyNGpqczKRyJmpZKCPN3EfTPIics/L830JnY/0DI4OpDqVvTJgOlHFX3L8K6Mr3J9lVqrFL0A/N6YKDsNw/+kb2DwjWQy2bUuOOwbLwKR5YByprro95amc4cKhUJlJbloaosBc0Ae+Kzk5O4F/bzJxkKq8sJvlcivccvWuGXrtbyCu71nz81h1/0e6ALm/YoRC4f1Fk/0XVT6EJ1ROAvy6W03Rr7KZDIuQNyy9wEfNNvIaik6kwKr7nG46h1C6AJQ4XS5PHE1btlngCFEAYYEhkCPXV5YuhK3BidExVR4uBVoQynqgx3J5FYqenBlRmW2Ntp1Hd+tII9ohw/rSpaRpchzwLa6LsqdteHXnYVuESzCwcYpfQIwDN98CmHqbwOvEWFnvN9+vVA4/0Oxt/s+gVGFn/5ysCqjwLzCJWC6Bn8pZtnv9RfnbppxJt+pRCo9IGNAWy9RM1lzNGJ3D94lnpSATdeS0sdK+dyHdb3HSu8w8E4IPN4usH6d1pRafNkXhALnglCAWef8dyVncgRkL0hHh29tj31ZCGhVxX/+es5FJ3uu6GR3KfoMy+1p6UmEZj8Cwu3LA80JHC86X663I7/k5E4Bp1qFNgVr1R03QqFFr2qcLJcnrrYT7H/5V8of4KEtLUuTJiAAAAAASUVORK5CYII=" class="edit"><br>

                <label for="username">Username: </label>
                <input type="text" name="username" id="username" required
                       pattern="^[a-zA-Z0-9]{3,20}$" oninvalid="this.setCustomValidity
                   ('Логін має містити лише літери англійської абетки та цифри, довжина від 3 до 20 символів')"
                       oninput="setCustomValidity('')" value="<?php echo $_SESSION['login']?>"><br>
                <label for="password">Password: </label>
                <input type="password" name="oldpassword" id="oldpassword" required><br>
                <label for="password">New password: </label>
                <input type="password" name="password" id="password" required
                       pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" oninvalid="this.setCustomValidity
                   ('Пароль має містити мінімум вісім символов, як мінімум одна велика літера, одна маленька літера і одна цифра')"
                       oninput="setCustomValidity('')" onkeyup='check();'><br>

                <label for="confirm_password">Confirm new password: </label>
                <input type="password" name="confirm_password" id="confirm_password" required
                       pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" onkeyup='check();'><br>
                <span id='message_error'></span><br>
                <p class="regtext">*If you will change your email, you should confirm your new address. We will send you a new link</p>
                <input type="button" name="submit" value="Change" id="register_button"/>
                <p class="regtext"><a href="account">Already registered? Login!</a></p>
            </form>
        <?php
    }
    ?>
    </div>
</div>