<script type="text/javascript">
	async function get_city() {
		let data = {
			name: document.getElementById('city').value,
			'<?= csrf_token() ?>': '<?= csrf_hash() ?>'
		};
		let districtDataList = document.getElementById('districts');
		while (districtDataList.firstChild) {
			districtDataList.removeChild(districtDataList.lastChild);
		}
		let DistrictsPromise = new Promise(function(resolve) {
			let xhr = new XMLHttpRequest();
			xhr.open('POST', '<?= esc($ajax_district, 'js') ?>');
			xhr.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					resolve(xhr.response);
				}
			};
			xhr.setRequestHeader("Content-Type", "application/json");
			xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
			xhr.send(JSON.stringify(data));
		});
		let districts = await DistrictsPromise;
		document.getElementById('district').removeAttribute("disabled");
		let districtsProcessed = JSON.parse(districts);
		districtsProcessed.forEach(function(district, index) {
			let optionElement = document.createElement('option');
			optionElement.value = district.name;
			districtDataList.appendChild(optionElement);
		});
	}

	async function get_district() {
		let data = {
			name: document.getElementById('district').value,
			'<?= csrf_token() ?>': '<?= csrf_hash() ?>'
		};
		let subdistrictDataList = document.getElementById('subdistricts');
		while (subdistrictDataList.firstChild) {
			subdistrictDataList.removeChild(subdistrictDataList.lastChild);
		}
		let DistrictsPromise = new Promise(function(resolve) {
			let xhr = new XMLHttpRequest();
			xhr.open('POST', '<?= esc($ajax_subdistrict, 'js') ?>');
			xhr.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					resolve(xhr.response);
				}
			};
			xhr.setRequestHeader("Content-Type", "application/json");
			xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
			xhr.send(JSON.stringify(data));
		});
		let subdistricts = await DistrictsPromise;
		document.getElementById('subdistrict').removeAttribute("disabled");
		let subdistrictsProcessed = JSON.parse(subdistricts);
		subdistrictsProcessed.forEach(function(subdistricts, index) {
			let optionElement = document.createElement('option');
			optionElement.value = subdistricts.name;
			subdistrictDataList.appendChild(optionElement);
		});
	}
	let timeout = null;
	let city = document.getElementById('city').addEventListener('keyup', function(e) {
		clearTimeout(timeout);
		timeout = setTimeout(get_city, 2000);
	});
	let district = document.getElementById('district').addEventListener('keyup', function(e) {
		clearTimeout(timeout);
		timeout = setTimeout(get_district, 2000);
	});
	document.getElementById('latitude-label').classList.add('active');
	document.getElementById('longitude-label').classList.add('active');
</script>