<script type="text/javascript">
async function get_province()
{
	let data = "name="+document.getElementById('province').value;
	let provinceDataList = document.getElementById('provinces');
	let provincePromise = new Promise(function(resolve) {
		let xhr = new XMLHttpRequest();
		xhr.open('POST','<?= esc($url_province,'js') ?>');
		xhr.onreadystatechange = function() {
			if(this.readyState==4 && this.status==200) {
				resolve(xhr.response);
			}
		};	
    	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    	xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
		xhr.send(data);
	});
	let provinceData = await provincePromise;
	let provinceProcessed = JSON.parse(provinceData);
	provinceProcessed.forEach(function(province,index){
		let optionElement = document.createElement('option');
		optionElement.value = province.id;
		optionElement.innerHTML = province.name;
		provinceDataList.appendChild(optionElement);
	});
}
let timeout = null;
let province = document.getElementById('province').addEventListener('keyup',function (e){
	
	clearTimeout(timeout);
	timeout=setTimeout(get_province,2000);
});
</script>