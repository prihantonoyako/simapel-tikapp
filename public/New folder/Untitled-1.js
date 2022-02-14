<!-- <script type="text/javascript">
    let freqBts = <?= esc($bts->frequency, 'js') ?>;
    let channel_width = "<?= esc($bts->channel_width, 'js') ?>";
    let band = "<?= esc($bts->band, 'js') ?>";
    let ssidBts = "<?= esc($bts->ssid, 'js') ?>";
    let tick_pos = init_tick_bts(band);
    let dataFreqBts = init_bts_freq(band, channel_width, freqBts);
    let dataSeries = [];
    let nameProc = ssidBts + ": " + freqBts;
    dataSeries.push({
        name: nameProc,
        data: dataFreqBts
    });
 let dataSeries = [];
 dataSeries.push({
   name: 'Yako',
   data: [
     [2412 - 11, 0],
     [2412, 1],
     [2412 + 11, 0]
   ]
 });

 dataSeries.push({
   name: 'Koko',
   data: [
     [2422 - 11, 0],
     [2422, 1],
     [2422 + 11, 0]
   ]
 });
 Highcharts.chart('radio-frequency-visualizer', {
   chart: {
     type: 'areaspline'
   },
   title: {
     text: null
   },
   // legend: {
     // layout: 'vertical',
     // align: 'left',
     // verticalAlign: 'top',
     // x: 150,
     // y: 100,
     // floating: true,
     // borderWidth: 1,
     // backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF'
   // },
   xAxis: {
     tickPositions: [2412, 2417, 2422, 2427, 2432, 2437, 2442, 2447, 2452, 2457, 2467, 2472, 2484]
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
   series: dataSeries
 });
</script> -->