const publicVapidKey = "BH25QhGzdhhFsj8D0Ws71rdpwvW4q_PuqHZRDmZpRoDlItnhRMQ9zvnTT4rfIklgWKxIkFfqqMu49ibGqfiaGlc";
window._push_host = "https://escalade-montesquieu-pusher.herokuapp.com";
// Check for service worker
if ("serviceWorker" in navigator) {
	send().catch(e => console.error(e));
}

async function send() {
	navigator.serviceWorker.register("/js/worker.js" )
		.then(onRegistration);
}

function onRegistration(registration) {
	if (registration.waiting) {
	  	registration.waiting.addEventListener('statechange', onStateChange('waiting', registration));
	}
  
	if (registration.installing) {
	  	registration.installing.addEventListener('statechange', onStateChange('installing', registration));
	}
  
	if (registration.active) {
		registration.active.addEventListener('statechange', onStateChange('active', registration));
	}
  }
  
function onStateChange(from, registration) {
	return function(e) {
		console.log(`From ${from} to ${e.target.state}`);
	  	if(e.target.state == 'activated') {
			registerPush(registration);
	  	}
	}
}

function registerPush(register) {
	// Register Push
	register.pushManager.subscribe({
		userVisibleOnly: true,
		applicationServerKey: urlBase64ToUint8Array(publicVapidKey),
	})
	.then(function(subscription) {
		console.log('Subscribing');
		fetch(`${window._push_host}/subscribe`, {
			method: "POST",
			body: JSON.stringify(subscription),
			headers: {
				"content-type": "application/json",
			},
		})
	})
}



function urlBase64ToUint8Array(base64String) {
	const padding = "=".repeat((4 - (base64String.length % 4)) % 4);
	const base64 = (base64String + padding)
		.replace(/\-/g, "+")
		.replace(/_/g, "/");

	const rawData = window.atob(base64);
	const outputArray = new Uint8Array(rawData.length);

	for (let i = 0; i < rawData.length; ++i) {
		outputArray[i] = rawData.charCodeAt(i);
	}
	return outputArray;
}


