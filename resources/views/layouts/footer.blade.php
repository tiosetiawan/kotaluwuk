
<div class="container-fluid">
	<br><hr class="footer">
	<p align="center">{{ ENV('APP_FOOTER') }}</p>
	<p align="center">Version  - Page rendered in <b>{{ microtime(true) }}</b> second </p>
</div>

<div id="loading"> 
	<div class="loader">
        {{-- <img src="<?php echo base_url('img/loading.gif'); ?>"> --}}
        <label>Data sedang di proses<label>
    </div> 
	<div class="overlay"></div>
</div>
