


<!-- Footer -->
<footer class="page-footer font-small pt-4" style="background-color: #212121; color: white;">

    <!-- Footer Links -->
    <div class="container-fluid text-center text-md-left">

      <!-- Grid row -->
      <div class="row">

        <!-- Grid column -->
        <div class="col-md-6 mt-md-0 mt-3">

          <!-- Content -->
          <h5 class="text-uppercase">Der Einkaufsmanager</h5>
          <p>Erfunden und Programmiert von Maximilian Göckler und Mathias Fallmann.</p>

        </div>
        <!-- Grid column -->

        <hr class="clearfix w-100 d-md-none pb-3">

        <!-- Grid column -->
        <div class="col-md-3 mb-md-0 mb-3"> </div>
          <!-- Grid column -->
          <div class="col-md-3 mb-md-0 mb-3">

            <!-- Links -->
            <h5 class="text-uppercase">Links</h5>

            <ul class="list-unstyled">
              <li style="padding: 5px;">
				 <button type="button" class="btn btn-outline-danger btn-sm" onClick="footerlinks(0)">Impressum</button>
              </li>
              <li style="padding: 5px;">
                <button type="button" class="btn btn-outline-danger btn-sm" onClick="footerlinks(1)">Kontakt</button>
              </li>
            </ul>

          </div>
          <!-- Grid column -->

      </div>
      <!-- Grid row -->

    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3 bg-dark">© <?php echo date("Y"); ?> Copyright: Maximilian Göckler & Mathias Fallmann
    </div>
    <!-- Copyright -->

  </footer>
  <!-- Footer -->
<script>
	function footerlinks(direction){
		if(direction == 0){
			window.location.href = "Impressum.php";
		}else if(direction == 1){
			window.location.href = "contact.php";
		}else if(direction == 2){
			window.location.href = "Team.php";
		}
	}

</script>