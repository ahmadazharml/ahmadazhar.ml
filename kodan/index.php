<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
	<script type="text/javascript" src="aes.js"></script> 
	<script src="FileSaver.js"></script>
	<style>
	
		.container {
		  max-width: 960px;
		}

		.header {
		  max-width: 700px;
		}
	
	</style>

    <title>Aes 256 CBC</title>
  </head>
  <body>

<div class="container">
<center><h1>Encode & Decode Text by AES 256 CBC Systems</h1></center>
	<div class="mb-3">
	  <label for="exampleFormControlTextarea1" class="form-label">Input(Normal Text)</label>
	  <textarea class="form-control" id="input" rows="5"></textarea>
	</div>
	 <label for="input-file">Text file only:</label>&nbsp;<input type="file" id="input-file">
	<div class="mb-3">
	  <label for="exampleFormControlInput1" class="form-label">Secret Key</label>
	  <input type="text" class="form-control" id="secretkey" placeholder="Example: 1234">
	</div>
	<button type="button" class="btn btn-warning" onclick="Decode()">Decode</button>
	<button type="button" class="btn btn-primary" onclick="Encode()">Encode</button>
	<div class="mb-3">
	  <label for="exampleFormControlTextarea1" class="form-label">Output(Encode & Decode Results)</label>
	  <textarea class="form-control" id="output" rows="5"></textarea>
	</div>	
	<button type="button" class="btn btn-info" onclick="saveFile()">Save to txt File</button>
	<button type="button" class="btn btn-success" onclick="copytoClipboard()">Copy to Clipboard</button>
	<button type="button" class="btn btn-danger" onclick="reload()">Clear</button>
	
 </div>
 
 	<script>
	
		document.getElementById('input-file')
		  .addEventListener('change', getFile)

		function getFile(event) {
			const input = event.target
		  if ('files' in input && input.files.length > 0) {
			  placeFileContent(
			  document.getElementById('input'),
			  input.files[0])
		  }
		}

		function placeFileContent(target, file) {
			readFileContent(file).then(content => {
			target.value = content
		  }).catch(error => console.log(error))
		}

		function readFileContent(file) {
			const reader = new FileReader()
		  return new Promise((resolve, reject) => {
			reader.onload = event => resolve(event.target.result)
			reader.onerror = error => reject(error)
			reader.readAsText(file)
		  })
		}	
	
	
		function Encode(){

			var message = document.getElementById("input").value;

			var seckey = document.getElementById("secretkey").value;

			var encrypted = CryptoJS.AES.encrypt(message, seckey);

			document.getElementById("output").value = encrypted;
			//document.getElementById("qrgen").value = encrypted;
			//alert(encrypted);	

			//makeCode();
		}
		
		
		function Decode(){
			
			var decode = document.getElementById("input").value;

			var seckey = document.getElementById("secretkey").value;

			var decrypted = CryptoJS.AES.decrypt(decode, seckey);

			var decpic = decrypted.toString(CryptoJS.enc.Utf8);			
			
			document.getElementById("output").innerHTML = decpic;
			

		}	
		
		function saveFile() {

            var userInput = document.getElementById("output").value;
			
            var blob = new Blob([userInput], { type: "text/plain;charset=utf-8" });
            saveAs(blob, "yourfilename.txt");
        }
		
		function copytoClipboard() {
			
		  var copyText = document.getElementById("output");
		  
		  copyText.select();
		  
		  copyText.setSelectionRange(0, 99999)
		  
		  document.execCommand("copy");
		  
		  alert("Copied the text: " + copyText.value);
		  
		}		
		
		function reload(){			
			location.reload();			
		}
		
	
	</script>
    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  </body>
</html>