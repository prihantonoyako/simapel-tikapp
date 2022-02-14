<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('styles') ?>
<style>
  #radio-frequency-visualizer {
    height: 400px;
  }

  .highcharts-figure,
  .highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
  }

  .highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
  }

  .highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
  }

  .highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
  }

  .highcharts-data-table td,
  .highcharts-data-table th,
  .highcharts-data-table caption {
    padding: 0.5em;
  }

  .highcharts-data-table thead tr,
  .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
  }

  .highcharts-data-table tr:hover {
    background: #f1f7ff;
  }
</style>
<?= $this->endSection() ?>

<?= $this->section('dashboard-content') ?>
<div class="section">
  <h4 class="header">LOCATION</h4>
  <div class="divider"></div>
  <div class="row">
    <div class="col s12 m12 l12">
      <div class="card-panel">
        <h4 class="header2">BAND 2.4GHz</h4>
        <div id="radio-frequency-visualizer-24"></div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col s12 m12 l12">
      <div class="card-panel">
        <h4 class="header2">BAND 5GHz</h4>
        <div id="radio-frequency-visualizer-5"></div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('Highcharts-9.2.1/code/highcharts.js') ?>"></script>
<script src="<?= base_url('Highcharts-9.2.1/code/modules/exporting.js') ?>"></script>
<script src="<?= base_url('Highcharts-9.2.1/code/modules/export-data.js') ?>"></script>
<script src="<?= base_url('Highcharts-9.2.1/code/modules/accessibility.js') ?>"></script>
<script src="<?= base_url('js/custom/bts-edit.js') ?>"></script>
<script type="text/javascript">
let allBTS5 = <?= $baseTransceiverStations5 ?>;
console.log(allBTS5);
let dataSeries5 = [];
let tick_pos5 = init_tick_bts(allBTS5[0].band);
  allBTS5.forEach(function(currentPemancar, index) {
    let dataBTS5 = init_bts_freq(currentPemancar.band, currentPemancar.channel_width, currentPemancar.frequency);
    dataSeries5.push({
      name: String(currentPemancar.name),
      data: dataBTS5
    });
  });
  Highcharts.chart('radio-frequency-visualizer-5', {
   chart: {
     type: 'areaspline'
   },
   title: {
     text: null
   },
   xAxis: {
     tickPositions: tick_pos5
   },
   yAxis: {
     tickPositioner: function() {
       var positions = [],
         tick = Math.floor(this.dataMin),
         increment = Math.ceil((this.dataMax - this.dataMin) / 6);

       if (this.dataMax !== null && this.dataMin !== null) {
         for (tick; tick - increment <= this.dataMax; tick += increment) {
           positions.push(tick);
         }
       }
       return positions;
     }
   },
   tooltip: {
     shared: true,
     valueSuffix: ' MHz'
   },
   credits: {
     enabled: false
   },
   plotOptions: {
     areaspline: {
       fillOpacity: 0.5
     }
   },
   series: dataSeries5
 });
</script>
<script type="text/javascript">
  let allBTS24 = <?= $baseTransceiverStations24 ?>;
  console.log(allBTS24);
  let dataSeries24 = [];

  let tick_pos24 = init_tick_bts(allBTS24[0].band);
  allBTS24.forEach(function(currentPemancar, index) {
    let dataBTS24 = init_bts_freq(currentPemancar.band, currentPemancar.channel_width, currentPemancar.frequency);
    dataSeries24.push({
      name: String(currentPemancar.name),
      data: dataBTS24
    });
  });
  Highcharts.chart('radio-frequency-visualizer-24', {
   chart: {
     type: 'areaspline'
   },
   title: {
     text: null
   },
   xAxis: {
     tickPositions: tick_pos24
   },
   yAxis: {
     tickPositioner: function() {
       var positions = [],
         tick = Math.floor(this.dataMin),
         increment = Math.ceil((this.dataMax - this.dataMin) / 6);

       if (this.dataMax !== null && this.dataMin !== null) {
         for (tick; tick - increment <= this.dataMax; tick += increment) {
           positions.push(tick);
         }
       }
       return positions;
     }
   },
   tooltip: {
     shared: true,
     valueSuffix: ' MHz'
   },
   credits: {
     enabled: false
   },
   plotOptions: {
     areaspline: {
       fillOpacity: 0.5
     }
   },
   series: dataSeries24
 });
</script>
<?= $this->endSection() ?>