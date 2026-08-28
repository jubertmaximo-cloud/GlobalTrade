let tasa = 0;

async function obtenerTasa() {
  let res = await fetch("https://api.exchangerate-api.com/v4/latest/ARS");
  let data = await res.json();
  tasa = data.rates.USD;
}

obtenerTasa();

function convertir() {
  let ars = document.getElementById("ars").value;

  if (!ars || tasa === 0) {
    document.getElementById("resultado").innerText = "USD: 0.00";
    return;
  }

  let usd = ars * tasa;

  document.getElementById("resultado").innerText =
    "USD: " + usd.toFixed(2);
}


function enviar() {
  const data = {
    valor: document.querySelector('input[name="valor"]').value,
    moneda: document.querySelector('select[name="moneda"]').value,
    incoterm: document.querySelector('select[name="incoterm"]').value,
    transporte: document.querySelector('select[name="transporte"]').value,
    urgencia: document.querySelector('select[name="urgencia"]').value
  };


  if (!data.valor) {
    alert("Completa el valor FOB");
    return;
  }

  localStorage.setItem("cotizacion", JSON.stringify(data));
  window.location.href = "confirmacion.html";
}