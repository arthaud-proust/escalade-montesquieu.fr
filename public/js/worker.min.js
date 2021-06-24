console.log("Service Worker Loaded...");

function isClientFocused() {
	return clients
		.matchAll({
			type: "window",
			includeUncontrolled: true,
		})
		.then((windowClients) => {
			let clientIsFocused = false;

			for (let i = 0; i < windowClients.length; i++) {
				const windowClient = windowClients[i];
				if (windowClient.focused) {
					clientIsFocused = true;
					break;
				}
			}

			return clientIsFocused;
		});
}

self.addEventListener("push", (e) => {
	const data = e.data.json();
	// console.log("Push Recieved...");
	self.registration.getNotifications().then(function (notifications) {
		notifications
			.filter((notification) => notification.data.forum == data.forum)
			.forEach((notification) => notification.close());
		const promiseChain = isClientFocused()
		.then((clientIsFocused) => {
			if (clientIsFocused) return
		
			// Client isn't focused, we need to show a notification.
			// return self.registration.showNotification(
			// 	`${data.author} - ${
			// 		data.forum.charAt(0).toUpperCase() +
			// 		data.forum.slice(1).replace(/-/g, " ")
			// 	}`,
			// 	{
			// 		body: data.content,
			// 		tag: `${data.forum}.${data.id}`,
			// 		icon:
			// 			"https://escalade-montesquieu.fr/assets/img/apple/apple-touch-icon-180x180.png",
			// 		badge: "https://escalade-montesquieu.fr/assets/img/favicon.ico",
			// 		vibrate: [200, 100, 200, 100, 200, 100, 200],
			// 		data: {
			// 			url: data.url,
			// 			forum: data.forum,
			// 			author: data.author,
			// 		},
			// 	}
			// );
		});
		self.registration.showNotification(
			`${data.author} - ${
				data.forum.charAt(0).toUpperCase() +
				data.forum.slice(1).replace(/-/g, " ")
			}`,
			{
				body: data.content,
				tag: `${data.forum}.${data.id}`,
				icon:
					"https://escalade-montesquieu.fr/assets/img/apple/apple-touch-icon-180x180.png",
				badge: "https://escalade-montesquieu.fr/assets/img/favicon.ico",
				vibrate: [200, 100, 200, 100, 200, 100, 200],
				data: {
					url: data.url,
					forum: data.forum,
					author: data.author,
				},
			}
		);
		
	});
});

self.addEventListener("fetch", (event) => {
	console.log(event);
});
self.addEventListener('activate', function(event) {
	console.log('SW Activate ');
});

self.addEventListener('install', function(event) {
	console.log('SW Install ');
});

self.onnotificationclick = function (event) {
	event.notification.close();

	// This looks to see if the current is already open and
	// focuses if it is
	event.waitUntil(
		clients
			.matchAll({
				type: "window",
			})
			.then(function (clientList) {
				for (var i = 0; i < clientList.length; i++) {
					var client = clientList[i];
					if (
						client.url == event.notification.url &&
						"focus" in client
					)
						return client.focus();
				}
				if (clients.openWindow)
					return clients.openWindow(event.notification.data.url);
			})
	);
};
