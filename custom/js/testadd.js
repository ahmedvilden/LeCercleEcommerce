function valider()
{
var test=1;
var nom=document.formadd.productName.value;
var rate=document.formadd.rate.value;
var quantity=document.formadd.quantity.value;




if(!validernomprenom(productName) || productName==null)
{
alert(" VERIFIER NOM ");
test=0;
}
if(!validertel(rate) || rate==null){
alert("VERIFIER rate");
test=0;
}
if(!validerchoix(quantity) || quantity==null){
	alert("Valider quantity");
	test=0;
}

if(test==1)
{
	alert("Informations acceptées !")
document.formadd.method="POST";
document.formadd.action="php_action/createProduct.php";
document.formadd.submit();
}

}


function validernomprenom(aa)
{
	var letters = /^[A-Za-z- -]+$/;
	if(aa.match(letters))
	{
		return true;
	}else 
	{
		return false;
	}
 }
function validertel(b)
{
	var numbers= /^[0-9]+$/
	if(b.match(numbers))
	{
		return true;
	}else 
	{
		return false;
	}
}
function validerchoix(b)
{
	var numbers= /^[0-9]+$/
	if(b.match(numbers))
	{
		return true;
	}else 
	{
		return false;
	}
}
