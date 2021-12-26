function valider()
{
var test=1;
var login=document.monform2.login.value;
var cin=document.monform2.cin.value;
var nom=document.monform2.nom.value;
var prenom=document.monform2.prenom.value;
var secteur=document.monform2.secteur.value;
var tel=document.monform2.tel.value;
var mail=document.monform2.mail.value;
var numpermis=document.monform2.numpermis.value;
var datenaiss=document.monform2.datenaiss.value;
datej= new Date();
anneej=datej.getFullYear()+"*";
anneej=anneej.substring(0,2);
if (datenaiss.length ==6) 
datenaiss=datenaiss.substring(0,2)+"/"+datenaiss.substring(4,2)+"/"+anneej+datenaiss.substring(6,4);
if (datenaiss.length ==8) 
datenaiss=datenaiss.substring(0,2)+"/"+datenaiss.substring(4,2)+"/"+datenaiss.substring(8,4);



if(!validernomprenom(nom) || nom==null)
{
alert(" VERIFIER NOM ");
test=0;
}
if(!validernomprenom(prenom) || prenom==null){
alert("VERIFIER PRENOM");
test=0;
}
if(!validertelcin(cin) || cin.length!=8 || cin==null){
	alert("Valider Cin");
	test=0;
}
if(!validertelcin(tel) || tel.length!=8 || tel==null){
	alert("VALIDER TEL");
	test=0;
}
if(!validermail(mail) || mail==null){
	alert("VALIDER MAIL");
	test=0;
}
if(!validertelcin(numpermis) || numpermis==null){
	alert("Verifier num permis");
	test=0;
}
if (!isvaliddate(datenaiss) ||datenaiss==null){
alert("verifier date");
test=0;
}
if (test==1){
	alert("DONE !!!!")
document.monform2.method="POST";
document.monform2.submit();
}
}

function validermail(m)
{
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(m))
  {
    return true;
  }
  else return false
}

function validertelcin(b)
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

function validernomprenom(a)
{
	var letters = /^[A-Za-z- -]+$/;
	if(a.match(letters))
	{
		return true;
	}else 
	{
		return false;
	}
}
function isvaliddate(d) {
var dateRegEx = /^((((0?[1-9]|[12]\d|3[01])[\.\-\/](0?[13578]|1[02])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|[12]\d|30)[\.\-\/](0?[13456789]|1[012])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|1\d|2[0-8])[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|(29[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00)))|(((0[1-9]|[12]\d|3[01])(0[13578]|1[02])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|[12]\d|30)(0[13456789]|1[012])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|1\d|2[0-8])02((1[6-9]|[2-9]\d)?\d{2}))|(2902((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00))))$/;
return d.match(dateRegEx);
	} 

function confirmation() {
      return confirm('Are you sure you want to do this?');
    }