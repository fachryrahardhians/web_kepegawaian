<?= $this->extend('dashboard/layout/main_layout') ?>
<?= $this->section('content') ?>
<style>
    #wrapper {
        position: relative;
        height: 100vh;
    }

    #loader {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
    }

    iframe {
        border: none;
        width: 100%;
        height: calc(88vh);
        display: block;
    }
</style>
<div class="wrapper">
    <div id="loader">Loading...</div>
    <iframe
        src="http://bit.ly/SurveiLayananKepegawaianDJSDA" onload="hideLoader()">
    </iframe>
</div>

<script>
    function hideLoader() {
        document.getElementById('loader').style.display = 'none';
    }
</script>
<?= $this->endSection() ?>