import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-app.js";

import {
  getFirestore, collection, addDoc, setDoc, doc,
  onSnapshot, query, orderBy
} from "https://www.gstatic.com/firebasejs/10.12.0/firebase-firestore.js";

import {
  getAuth, signInAnonymously, onAuthStateChanged
} from "https://www.gstatic.com/firebasejs/10.12.0/firebase-auth.js";

import {
  getStorage, ref, uploadBytes, getDownloadURL
} from "https://www.gstatic.com/firebasejs/10.12.0/firebase-storage.js";

// CONFIG
const firebaseConfig = {
  apiKey: "846140280738",
  authDomain: "messagerie-cd2ba.firebaseapp.com",
  projectId: "messagerie-cd2ba",
  storageBucket: "messagerie-cd2ba.appspot.com"
};

const app = initializeApp(firebaseConfig);
const db = getFirestore(app);
const auth = getAuth(app);
const storage = getStorage(app);

let uid = null;
let currentChat = null;

// LOGIN
signInAnonymously(auth);

onAuthStateChanged(auth, (user) => {
  uid = user.uid;
  loadUsers();
});

// PSEUDO
window.savePseudo = async function () {
  const name = document.getElementById("pseudo").value;
  await setDoc(doc(db, "users", uid), { name });
};

// USERS
function loadUsers() {
  onSnapshot(collection(db, "users"), snap => {
    const div = document.getElementById("users");
    div.innerHTML = "";

    snap.forEach(u => {
      if (u.id === uid) return;

      const data = u.data();
      const el = document.createElement("div");

      el.innerText = data.name || "Utilisateur";
      el.onclick = () => openChat(u.id);

      div.appendChild(el);
    });
  });
}

// CHAT
function openChat(otherUser) {
  currentChat = [uid, otherUser].sort().join("_");

  const q = query(collection(db, "messages"), orderBy("date"));

  onSnapshot(q, snap => {
    const box = document.getElementById("messages");
    box.innerHTML = "";

    snap.forEach(docu => {
      const data = docu.data();
      if (data.chatId !== currentChat) return;

      const div = document.createElement("div");
      div.className = "msg";

      if (data.from === uid) div.classList.add("me");

      if (data.text) div.innerHTML += `<p>${data.text}</p>`;
      if (data.imageUrl) div.innerHTML += `<img src="${data.imageUrl}">`;

      box.appendChild(div);
    });

    box.scrollTop = box.scrollHeight;
  });
}

// SEND TEXT
window.send = async function () {
  const input = document.getElementById("msg");

  if (!input.value || !currentChat) return;

  await addDoc(collection(db, "messages"), {
    text: input.value,
    from: uid,
    chatId: currentChat,
    date: Date.now()
  });

  input.value = "";
};

// SEND IMAGE
document.getElementById("imageInput").addEventListener("change", async (e) => {
  const file = e.target.files[0];
  if (!file || !currentChat) return;

  const storageRef = ref(storage, "images/" + Date.now() + file.name);

  await uploadBytes(storageRef, file);
  const url = await getDownloadURL(storageRef);

  await addDoc(collection(db, "messages"), {
    imageUrl: url,
    from: uid,
    chatId: currentChat,
    date: Date.now()
  });
});
