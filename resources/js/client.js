const publicVapidKey = "BH25QhGzdhhFsj8D0Ws71rdpwvW4q_PuqHZRDmZpRoDlItnhRMQ9zvnTT4rfIklgWKxIkFfqqMu49ibGqfiaGlc";
// window._push_host = "https://escalade-montesquieu-pusher.herokuapp.com";
// window._push_host = "https://api.escalade-montesquieu.fr";
window._push_host = "http://localhost:8001";
// window._push_host = "http://192.168.0.21:8001";
// Check for service worker
if ("serviceWorker" in navigator) {
	send().catch(e => console.error(e));
}
function getForumsLastMessages() {
	axios({
		method: 'get',
		url: `/message/latests`,
	})
	.then(r=>{
		let newMessages = false

		r.data.latests.forEach(msg=>{
			if(localStorage.getItem(msg.forum+'.last_message')!==null) {
				
				// console.log(' ');
				// console.log("Server "+JSON.parse(new Date(msg.created_at).getTime()));
				// console.log("Client "+JSON.parse(localStorage.getItem(msg.forum+'.last_message')));
				// console.log('or :');
				// console.log("Server "+msg.created_at);
				// console.log("Client "+new Date(JSON.parse(localStorage.getItem(msg.forum+'.last_message'))));

				if( (JSON.parse(new Date(msg.created_at).getTime()) - JSON.parse(localStorage.getItem(msg.forum+'.last_message')) ) > 2000 ) {
					newMessages = true
					console.log(`${msg.forum.split('.')[0]}: nouveaux messages (${msg.created_at})`);
					$(`.link-forum[data-forum="${msg.forum.split('.')[0]}"]`).addClass('has-new-messages');
					// console.log(`.card-forum[data-forum="${msg.forum.split('.')[0]}"]`);
					$(`.card-forum[data-forum="${msg.forum.split('.')[0]}"]`).addClass('has-new-messages');
					newMessages = true;
				} else {
					console.log(`${msg.forum.split('.')[0]}: à jour (${msg.created_at})`);
				}
			} else {
				$(`.link-forum[data-forum="${msg.forum.split('.')[0]}"]`).addClass('has-new-messages');
				$(`.card-forum[data-forum="${msg.forum.split('.')[0]}"]`).addClass('has-new-messages');
				newMessages = true;
			}
		});
		// console.log(newMessages);
		if(newMessages ) {
			$(`.nav-link-forums`).addClass('has-new-messages')
			$(`.navbar-toggler`).addClass('has-new-messages')
		}
	})
}

getForumsLastMessages();
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


