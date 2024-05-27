
<script type="text/javascript">
	
	function DoProcessCode(strCode, inputEmail)
	{
		let nPos1 = strCode.indexOf("Send Email") + 11,
			nPos2 = strCode.indexOf("\"", nPos1 + 1),
			strEmailList = inputEmail.value + "\n",
			strEmail = "";
			
		if ((nPos1 > -1) && (nPos2 > 0))
		{
			strEmail = strCode.substring(nPos1, nPos2);
			strEmailList = inputEmail.value;
			strEmailList += strEmail + ";\n";
			inputEmail.value = strEmailList;
		}
	}
	
</script>
<textarea id="code" cols="160" rows="20"></textarea>
<br/><br/>
<button type="button" onclick="DoProcessCode(document.getElementById('code').value, document.getElementById('email'))">GET EMAIL ADDRESS</button>
&nbsp;
<button type="button" onclick="document.getElementById('code').value = ''">CLEAR</button>
<br/><br/>
<textarea id="email" cols="60" rows="20"></textarea>


