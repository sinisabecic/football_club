<link rel="stylesheet" href="public/fa/css/font-awesome.min.css">

<!-- Footer -->
<footer class="page-footer font-small blue pt-4" style="padding-top:50px; padding-bottom:50px;">
    <div class="container">

        <!-- Footer Links -->
        <div class="container text-center text-md-left" style="padding-bottom:40px;">

            <!-- Grid row -->
            <div class="row">

                <!-- Grid column -->
                <div class="col-md-6 mt-md-0 mt-3 text-left futer-opis">

                    <!-- Content -->
                    <h4 class="text-uppercase bold-zuta">Trivija</h4>
                    <p><strong class="zuta">Puno ime:</strong> West Ham United Football Club <br>
                        <strong class="zuta">Nadimak:</strong> Čekićari, Gvozdeni, Akademija fudbala<br>
                        <strong class="zuta">Osnovan:</strong> 1895. kao Thames Ironworks F.C.<br>
                        <strong class="zuta">Stadion:</strong> Olimpijski stadion, London</p>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3 text-justify futer-opis w-ham">

                    <!-- Links -->
                    <h5 class="text-uppercase bold-zuta">West Ham United</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="/pages/about">O klubu</a>
                        </li>
                        <li>
                            <a href="/pages/blog">Novosti</a>
                        </li>
                        <?php if (!isset($_SESSION['fk_id'])) { ?>
                        <li>
                            <a href="/pages/login">Prijava</a>
                        </li>
                        <li>
                            <a href="/pages/register">Registracija</a>
                        </li>
                        <?php
} ?>
                    </ul>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3 text-justify soc-web">

                    <!-- Links -->
                    <h5 class="text-uppercase bold-zuta" style="margin-bottom:15px">Pratite nas</h5>

                    <a href="#!"><i class="fa fa-facebook fa-lg white-text mr-md-5 mr-3 fa-2x"></i> </a>

                    <a href="#!"><i class="fa fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"></i> </a>


                    <a href="#!"><i class="fa fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x">
                        </i></a>



                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->





        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2020 Copyright:
            <a href="index.php"> westhamfk.com</a>
        </div>
        <!-- Copyright -->

    </div>
</footer>
<!-- Footer -->

<script src="public/js/jquery.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src=" https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js">
</script>

<script src="public/js/jquery.toast.js"></script>
<script src="public/js/jquery.validate.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>

</body>

</html>