<?= $this->extend('admin/layout/main_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
  <div class="row">
    <!-- Chart 1 -->
    <div class="col-md-6 col-12 mb-3">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Statistik A</h3>
        </div>
        <div class="card-body">
          <canvas id="chartA"></canvas>
        </div>
      </div>
    </div>

    <!-- Chart 2 -->
    <div class="col-md-6 col-12 mb-3">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Statistik B</h3>
        </div>
        <div class="card-body">
          <canvas id="chartB"></canvas>
        </div>
      </div>
    </div>

    <!-- Chart 3 -->
    <div class="col-md-6 col-12 mb-3">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Statistik C</h3>
        </div>
        <div class="card-body">
          <canvas id="chartC"></canvas>
        </div>
      </div>
    </div>

    <!-- Chart 4 -->
    <div class="col-md-6 col-12 mb-3">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Statistik D</h3>
        </div>
        <div class="card-body">
          <canvas id="chartD"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Chart.js CDN jika belum ada -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const dummyData = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
    datasets: [{
      label: 'Data Dummy',
      data: [12, 19, 3, 5, 2, 3],
      backgroundColor: 'rgba(60,141,188,0.7)',
      borderColor: 'rgba(60,141,188,1)',
      borderWidth: 1
    }]
  };

  const config = (type = 'bar') => ({
    type: type,
    data: dummyData,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  new Chart(document.getElementById('chartA'), config('bar'));
  new Chart(document.getElementById('chartB'), config('line'));
  new Chart(document.getElementById('chartC'), config('pie'));
  new Chart(document.getElementById('chartD'), config('doughnut'));
</script>

<?= $this->endSection() ?>