const chatWindow = document.getElementById("chatWindow");
const advisorForm = document.getElementById("advisorForm");
const advisorMessage = document.getElementById("advisorMessage");
const quickButtons = document.querySelectorAll(".quick-actions button");

const responses = [
  "Estoy consultando la informacion con operaciones. En unos minutos te confirmo el siguiente paso.",
  "La solicitud quedo registrada. Voy a revisar documentacion, transporte y cobertura disponible.",
  "Para avanzar podemos validar factura comercial, packing list y datos del consignatario.",
  "El equipo de aduana esta preparando una respuesta preliminar para tu operacion."
];

function addMessage(type, text) {
  const message = document.createElement("div");
  message.className = `message ${type}`;

  const paragraph = document.createElement("p");
  paragraph.textContent = text;

  const time = document.createElement("small");
  time.textContent = new Date().toLocaleTimeString("es-AR", {
    hour: "2-digit",
    minute: "2-digit"
  });

  if (type === "advisor") {
    const name = document.createElement("strong");
    name.textContent = "Marina - Global Trade";
    message.appendChild(name);
  }

  message.appendChild(paragraph);
  message.appendChild(time);
  chatWindow.appendChild(message);
  chatWindow.scrollTop = chatWindow.scrollHeight;
}

function sendSimulatedMessage(text) {
  const cleanText = text.trim();

  if (!cleanText) {
    return;
  }

  addMessage("user", cleanText);
  advisorMessage.value = "";

  setTimeout(() => {
    const response = responses[Math.floor(Math.random() * responses.length)];
    addMessage("advisor", response);
  }, 650);
}

advisorForm.addEventListener("submit", (event) => {
  event.preventDefault();
  sendSimulatedMessage(advisorMessage.value);
});

quickButtons.forEach((button) => {
  button.addEventListener("click", () => {
    sendSimulatedMessage(button.dataset.message);
  });
});
