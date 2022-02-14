function init_tick_bts(band) {
    let bandofBts = band.substring(0, 4);
    let tick_pos = new Array();
    if (bandofBts == "2ghz") {
        //frekuensi 2484 hanya boleh di country japan dan 802.11b
        for (let i = 2412; i <= 2472; i += 5) {
            tick_pos.push(i);
        }
        tick_pos.push(2484);
    } else if (bandofBts == "5ghz") {
        for (let i = 5160; i <= 5720; i += 20) {
            tick_pos.push(i);
        }
        for (let i = 5745; i <= 5885; i += 20) {
            tick_pos.push(i);
        }
    }
    return tick_pos;
}

function init_bts_freq(band, channel, zero_freq) {
    //sanitize variables
    let sanitized_freq = parseInt(zero_freq);
    let band_freq = band.substring(0, 4);
    let true_protocol = get_true_protocol(band);
    let true_channel = get_true_channel(channel);
    let data;
    if (true_protocol == "a" || true_protocol == "b") {
        data = get_dsss_frequency(zero_freq);
    }
    else {
        data = get_ofdm_frequency(true_channel, zero_freq);
    }
    // // 2ghz-b & 5ghz-a
    // // g/n
    // //logic for channel bonding

    return data;
}

function get_true_channel(channel) {
    let unproc = channel.split("-");
    let dirty_channel = unproc[0].split("/");
    let channel_proc = dirty_channel[dirty_channel.length - 1];
    let lastIndexM = channel_proc.lastIndexOf("m");
    let channel_true = parseFloat(channel_proc.slice(0, lastIndexM));
    if (unproc.length == 1) {
        return channel_true;
    }
    extra_channel = unproc[1].slice();
    return [channel_true, extra_channel];
}

function get_true_protocol(band) {
    let unproc = band.split("-");
    //search if onlyX exist
    let lastIndexY = unproc[1].search("only");
    if (lastIndexY == -1) {
        //for b or a
        if (unproc[1].length == 1) {
            return unproc[1];
        }
        // for b/g/n and a/n/ac
        let dirty_protocol = unproc[1].split("/");
        let protocol_proc = dirty_protocol[dirty_protocol.length - 1];
        return protocol_proc;
    }
    let true_protocol = unproc[1].substring(4);
    return true_protocol;
}

function get_ofdm_frequency(channel, freq) {
    let unproc_subcarrier, data = new Array(), control_freq;
    freq = parseFloat(freq);
    if (Array.isArray(channel)) {
        /* Currently, only supported eC or Ce channel bonding
         * Not supported XX and above 2 channel bonding (not real tested)
        */
        control_freq = channel[1].lastIndexOf("C");
        channel_bonding = channel[1].length;
        let standard_channel = 20;
        let offset_freq = Math.floor(channel[0] / 2);
        unproc_subcarrier = 33.75;
        let proc_carrier = unproc_subcarrier / 2;
        let offset_freq_bond = offset_freq;
        let std_c2 = standard_channel / 2;
        let upper_freq = freq + std_c2;
        let lower_freq = freq - std_c2;
        let extra_separator = channel[1].split("C");
        // for eC temporary logic
        // if(channel[1] == "eC"){
        //     data.push([

        //     ]);
        // }
        //for center frequency
        data.push([
            freq - std_c2, 0
        ]);
        data.push([
            freq - (proc_carrier - std_c2), 1
        ]);
        data.push([
            freq + (proc_carrier - std_c2), 1
        ]);
        data.push([
            freq + std_c2, 0
        ]);
        //for extra channel
        // for (let i = channel_bonding; i > 0; i--) {
        //     // 2412 - 2432
        //     if (channel_bonding == 1) {
        //         data.push([
        //             upper_freq - offset_freq_bond,1
        //         ]);
        //         data.push([
        //             upper_freq - offset_freq_bond, 0
        //         ]);
        //     } else {
        //         data.push([
        //             upper_freq - offset_freq, 1
        //         ]);
        //     }
        //     offset_freq_bond += 20;
        // }
        //for channel_extra
        // for (let i = channel_bonding; i > 0; i--) {
        //     // 2412 - 2432
        //     if (channel_bonding == 1) {
        //         data.push([
        //             upper_freq - offset_freq_bond,1
        //         ]);
        //         data.push([
        //             upper_freq - offset_freq_bond, 0
        //         ]);
        //     } else {
        //         data.push([
        //             upper_freq - offset_freq, 1
        //         ]);
        //     }
        //     offset_freq_bond += 20;
        // }
    }
    // standard channel 20
    else {
        let standard_channel = 20;
        unproc_subcarrier = 16.25;
        let proc_carrier = unproc_subcarrier / 2;
        data.push([
            freq - standard_channel, 0
        ]);
        data.push([
            freq - proc_carrier, 1
        ]);
        data.push([
            freq + proc_carrier, 1
        ]);
        data.push([
            freq + standard_channel, 0
        ]);
    }
    return data;
}

function get_dsss_frequency(frequency) {
    frequency = parseFloat(frequency);
    data.push([
        frequency - 10, 0
    ]);
    data.push([
        frequency, 1
    ]);
    data.push([
        freq + 10, 0
    ]);
}