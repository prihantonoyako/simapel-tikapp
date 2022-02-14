/*  Constraint for this program
    installation: any
    wireless-protocol: 802.11
    country: no_country_set
*/
function frequencyInit() {
    var sel = document.getElementById('frequency');
    if (sel != null) {
        for (i = sel.length - 1; i >= 0; i--) {
            sel.remove(i);
        }
    }
}

function frequencySelect(band, channel_width) {
    if (band == "2ghz") {
        if (channel_width == "5mhz" || channel_width == "10mhz") {
            for (let i = 2407; i <= 2467; i += 5) {
                var element = document.createElement('option');
                element.value = i;
                element.textContent = i;
                $("#frequency").append(element);
            }
        }
        else if (channel_width == "20mhz") {
            for (let i = 2412; i <= 2462; i += 5) {
                var element = document.createElement('option');
                element.value = i;
                element.textContent = i;
                $("#frequency").append(element);
            }
        }
        else if (channel_width == "20/40mhz-Ce") {
            for (let i = 2412; i <= 2442; i += 5) {
                var element = document.createElement('option');
                element.value = i;
                element.textContent = i;
                $("#frequency").append(element);
            }
        }
        else if (channel_width == "20/40mhz-eC" || channel_width == "20/40mhz-XX") {
            for (let i = 2432; i <= 2462; i += 5) {
                var element = document.createElement('option');
                element.value = i;
                element.textContent = i;
                $("#frequency").append(element);
            }
        }
    } else if (band == "5ghz") {
        if (channel_width == "20mhz"){
            for (let i = 5160; i <= 5720; i += 20) {
                var element = document.createElement('option');
                element.value = i;
                element.textContent = i;
                $("#frequency").append(element);
            }
            for (let i = 5745; i <= 5885; i += 20) {
                var element = document.createElement('option');
                element.value = i;
                element.textContent = i;
                $("#frequency").append(element);
            }
        }
        else if (channel_width == "20/40mhz-Ce"){
            for (let i = 5180; i <= 5680; i += 20) {
                var element = document.createElement('option');
                element.value = i;
                element.textContent = i;
                $("#frequency").append(element);
            }
            for (let i = 5745; i <= 5805; i += 20) {
                var element = document.createElement('option');
                element.value = i;
                element.textContent = i;
                $("#frequency").append(element);
            }
        }
        else if (channel_width == "20/40mhz-eC"){
            for (let i = 5200; i <= 5700; i += 20) {
                var element = document.createElement('option');
                element.value = i;
                element.textContent = i;
                $("#frequency").append(element);
            }
            for (let i = 5765; i <= 5825; i += 20) {
                var element = document.createElement('option');
                element.value = i;
                element.textContent = i;
                $("#frequency").append(element);
            }
        }
    }
}