<?php
// Données simulées
$emails = [
    ["id" => 1, "from" => "Google", "email" => "noreply@google.com", "subject" => "Votre récapitulatif de sécurité", "preview" => "Votre compte Google a été connecté depuis un nouvel appareil...", "body" => "Bonjour,\n\nVotre compte Google a été connecté depuis un nouvel appareil le 7 avril 2026 à 09h14.\n\nSi c'était vous, vous pouvez ignorer ce message.\n\nCordialement,\nL'équipe Google", "time" => "09:14", "date" => "7 avr.", "read" => false, "starred" => true, "label" => "primary"],
    ["id" => 2, "from" => "LinkedIn", "email" => "messages@linkedin.com", "subject" => "3 nouvelles connexions vous attendent", "preview" => "Marie Dupont, Jean Martin et 1 autre personne souhaitent se connecter avec vous...", "body" => "Bonjour,\n\nVous avez 3 nouvelles invitations à rejoindre votre réseau :\n\n• Marie Dupont – Développeuse FullStack chez Capgemini\n• Jean Martin – Chef de projet chez Orange\n• Sophie Bernard – Designer UX chez LVMH\n\nAcceptez leurs invitations et élargissez votre réseau professionnel.\n\nL'équipe LinkedIn", "time" => "08:52", "date" => "7 avr.", "read" => false, "starred" => false, "label" => "social"],
    ["id" => 3, "from" => "Thomas Lefèvre", "email" => "thomas.lefevre@example.com", "subject" => "Re: Réunion de projet – Mardi 9 avril", "preview" => "Bonjour, confirme ma présence pour la réunion de mardi. J'apporterai le compte-rendu de la semaine...", "body" => "Bonjour,\n\nJe confirme ma présence pour la réunion de mardi 9 avril à 14h00.\n\nJ'apporterai le compte-rendu de la semaine dernière ainsi que les nouvelles maquettes.\n\nÀ bientôt,\nThomas", "time" => "Hier", "date" => "6 avr.", "read" => true, "starred" => false, "label" => "primary"],
    ["id" => 4, "from" => "Notion", "email" => "team@notion.so", "subject" => "Claire a partagé un document avec vous", "preview" => "Claire Moreau vous a partagé « Roadmap Q2 2026 » – cliquez pour accéder au document...", "body" => "Bonjour,\n\nClaire Moreau vous a partagé un document Notion :\n\n📄 Roadmap Q2 2026\n\nCliquez sur le lien ci-dessous pour accéder au document et collaborer en temps réel.\n\nBonne lecture,\nL'équipe Notion", "time" => "Hier", "date" => "6 avr.", "read" => true, "starred" => true, "label" => "primary"],
    ["id" => 5, "from" => "Amazon", "email" => "auto-confirm@amazon.fr", "subject" => "Votre commande a été expédiée", "preview" => "Votre commande #123-4567890 a été expédiée et sera livrée le jeudi 9 avril...", "body" => "Bonjour,\n\nBonne nouvelle ! Votre commande #123-4567890 a été expédiée.\n\nLivraison estimée : jeudi 9 avril 2026\nTransporteur : Chronopost\nNuméro de suivi : CP123456789FR\n\nCordialement,\nAmazon.fr", "time" => "5 avr.", "date" => "5 avr.", "read" => true, "starred" => false, "label" => "updates"],
    ["id" => 6, "from" => "Newsletter Dev.to", "email" => "newsletter@dev.to", "subject" => "🔥 Les 10 articles les plus lus cette semaine", "preview" => "Rust vs Go en 2026, les nouvelles features de React 20, TypeScript 6.0 est là...", "body" => "Bonjour,\n\nVoici les articles les plus populaires cette semaine sur DEV.to :\n\n1. Rust vs Go en 2026 : quel langage choisir ?\n2. React 20 : toutes les nouvelles fonctionnalités\n3. TypeScript 6.0 est disponible\n4. 10 outils CLI indispensables\n5. Architecture microservices vs monolithe en 2026\n\nBonne lecture !\nL'équipe DEV.to", "time" => "4 avr.", "date" => "4 avr.", "read" => false, "starred" => false, "label" => "updates"],
    ["id" => 7, "from" => "Camille Rousseau", "email" => "camille.rousseau@gmail.com", "subject" => "Weekend à Lyon – tu es dispo ?", "preview" => "Salut ! On pense organiser un weekend à Lyon fin avril, tu serais partant ?", "body" => "Salut !\n\nOn est en train d'organiser un weekend à Lyon du 25 au 27 avril avec quelques amis. Tu serais partant ?\n\nOn pense visiter le Vieux-Lyon, faire une balade en Beaujolais et bien sûr manger de la bonne cuisine lyonnaise 😄\n\nTiens-moi au courant !\nCamille", "time" => "3 avr.", "date" => "3 avr.", "read" => true, "starred" => false, "label" => "primary"],
    ["id" => 8, "from" => "GitHub", "email" => "noreply@github.com", "subject" => "[my-project] Pull request merged by alex_dev", "preview" => "alex_dev merged pull request #42: feat: add dark mode support into main...", "body" => "Bonjour,\n\nalex_dev a fusionné la pull request #42 dans le dépôt my-project :\n\n🔀 feat: add dark mode support → main\n\n3 fichiers modifiés, +245 lignes, -12 lignes\n\nConsultez les changements sur GitHub.\n\nL'équipe GitHub", "time" => "2 avr.", "date" => "2 avr.", "read" => true, "starred" => false, "label" => "updates"],
];

$user = ["name" => "Utilisateur Gmail", "email" => "utilisateur@gmail.com", "avatar" => "U"];
$active_email = isset($_GET['id']) ? (int)$_GET['id'] : null;
$active_tab = $_GET['tab'] ?? 'primary';
$compose = isset($_GET['compose']);

function getInitials($name) {
    $parts = explode(' ', $name);
    return strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
}

function getAvatarColor($name) {
    $colors = ['#1a73e8','#e8710a','#0f9d58','#a142f4','#d93025','#00838f','#f29900'];
    return $colors[ord($name[0]) % count($colors)];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gmail</title>
<link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@400;500;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
:root {
  --primary: #1a73e8;
  --primary-light: #e8f0fe;
  --surface: #fff;
  --bg: #f6f8fc;
  --border: #e0e0e0;
  --text: #202124;
  --text-secondary: #5f6368;
  --hover: #f1f3f4;
  --unread-bg: #fff;
  --red: #d93025;
  --sidebar-w: 256px;
}
body { font-family: 'Google Sans', Roboto, sans-serif; background: var(--bg); color: var(--text); height: 100vh; overflow: hidden; display: flex; flex-direction: column; }

/* HEADER */
header { display: flex; align-items: center; padding: 8px 16px; gap: 8px; background: var(--bg); position: relative; z-index: 100; height: 64px; flex-shrink: 0; }
.logo { display: flex; align-items: center; gap: 4px; width: 220px; flex-shrink: 0; }
.logo img { height: 28px; }
.logo-text { font-size: 22px; color: var(--text-secondary); font-weight: 400; letter-spacing: -0.5px; }
.logo-text span { color: #4285f4; }
.logo-text span:nth-child(2) { color: #ea4335; }
.logo-text span:nth-child(3) { color: #fbbc05; }
.logo-text span:nth-child(4) { color: #4285f4; }
.logo-text span:nth-child(5) { color: #34a853; }
.logo-text span:nth-child(6) { color: #ea4335; }

.search-bar { flex: 1; max-width: 720px; position: relative; }
.search-bar input { width: 100%; padding: 10px 48px 10px 56px; border: none; border-radius: 24px; background: #eaf1fb; font-size: 16px; font-family: 'Google Sans', sans-serif; color: var(--text); outline: none; transition: all 0.2s; }
.search-bar input:focus { background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.2); }
.search-icon { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-secondary); }
.search-filter { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: var(--text-secondary); cursor: pointer; }

.header-actions { margin-left: auto; display: flex; align-items: center; gap: 4px; }
.icon-btn { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--text-secondary); border: none; background: none; transition: background 0.15s; }
.icon-btn:hover { background: var(--hover); }
.avatar { width: 32px; height: 32px; border-radius: 50%; background: #1a73e8; color: white; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 500; cursor: pointer; }

/* LAYOUT */
.app-body { display: flex; flex: 1; overflow: hidden; }

/* SIDEBAR */
nav { width: var(--sidebar-w); flex-shrink: 0; padding: 8px 0; overflow-y: auto; }
.compose-btn { margin: 4px 8px 16px; padding: 16px 24px; background: #c2e7ff; border: none; border-radius: 16px; display: flex; align-items: center; gap: 12px; cursor: pointer; font-size: 14px; font-family: 'Google Sans'; font-weight: 500; color: var(--text); transition: all 0.2s; box-shadow: 0 1px 3px rgba(0,0,0,0.15); }
.compose-btn:hover { box-shadow: 0 2px 6px rgba(0,0,0,0.2); background: #a8d8f8; }
.compose-btn .material-icons { font-size: 20px; }
.nav-item { display: flex; align-items: center; padding: 4px 16px 4px 26px; height: 32px; border-radius: 0 16px 16px 0; cursor: pointer; color: var(--text); text-decoration: none; font-size: 14px; gap: 16px; font-family: 'Google Sans'; transition: background 0.15s; width: calc(100% - 0px); margin-right: 16px; }
.nav-item:hover { background: var(--hover); }
.nav-item.active { background: var(--primary-light); font-weight: 700; }
.nav-item .material-icons { font-size: 20px; color: var(--text-secondary); }
.nav-item.active .material-icons { color: var(--text); }
.nav-badge { margin-left: auto; font-size: 12px; font-weight: 400; }
.nav-divider { height: 1px; background: var(--border); margin: 8px 0; }
.nav-section { padding: 4px 26px; font-size: 11px; font-weight: 500; color: var(--text-secondary); letter-spacing: 0.5px; margin-top: 8px; }

/* MAIN */
main { flex: 1; display: flex; flex-direction: column; overflow: hidden; background: var(--surface); border-radius: 16px; margin: 0 8px 8px 0; }

/* TABS */
.tabs { display: flex; border-bottom: 1px solid var(--border); padding: 0 16px; flex-shrink: 0; }
.tab { padding: 14px 20px; cursor: pointer; font-size: 14px; color: var(--text-secondary); border-bottom: 3px solid transparent; margin-bottom: -1px; display: flex; align-items: center; gap: 8px; transition: all 0.15s; text-decoration: none; }
.tab:hover { background: var(--hover); color: var(--text); }
.tab.active { color: var(--primary); border-bottom-color: var(--primary); font-weight: 500; }
.tab .material-icons { font-size: 18px; }
.tab-badge { background: #d93025; color: white; border-radius: 10px; padding: 1px 6px; font-size: 11px; font-weight: 500; }

/* TOOLBAR */
.toolbar { display: flex; align-items: center; padding: 4px 8px; border-bottom: 1px solid var(--border); gap: 4px; flex-shrink: 0; height: 48px; }
.toolbar .icon-btn { color: var(--text-secondary); }
.toolbar-divider { width: 1px; height: 24px; background: var(--border); margin: 0 4px; }
.page-info { margin-left: auto; font-size: 13px; color: var(--text-secondary); display: flex; align-items: center; gap: 8px; }

/* EMAIL LIST */
.email-list { flex: 1; overflow-y: auto; }
.email-row { display: flex; align-items: center; padding: 0 16px; height: 56px; cursor: pointer; border-bottom: 1px solid transparent; position: relative; transition: all 0.1s; }
.email-row:hover { box-shadow: 0 2px 8px rgba(0,0,0,0.1); z-index: 1; background: #f2f6fc; }
.email-row.unread { font-weight: 700; background: var(--unread-bg); }
.email-row.active { background: #e8f0fe; }
.email-row:not(:last-child) { border-bottom-color: var(--border); }

.row-check { width: 40px; display: flex; align-items: center; justify-content: center; }
.row-check input[type=checkbox] { width: 16px; height: 16px; cursor: pointer; }
.row-star { width: 32px; display: flex; align-items: center; color: #5f6368; font-size: 18px; }
.row-star .material-icons { font-size: 18px; cursor: pointer; }
.row-star .material-icons.starred { color: #f4b400; }
.row-avatar { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 14px; font-weight: 500; flex-shrink: 0; margin-right: 8px; }
.row-from { width: 160px; flex-shrink: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 14px; }
.row-content { flex: 1; overflow: hidden; display: flex; align-items: center; gap: 8px; min-width: 0; }
.row-subject { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 14px; }
.row-preview { color: var(--text-secondary); font-weight: 400; font-size: 14px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; flex: 1; }
.row-preview::before { content: ' – '; }
.row-time { width: 60px; text-align: right; font-size: 12px; color: var(--text-secondary); flex-shrink: 0; }
.email-row.unread .row-time { font-weight: 700; color: var(--text); }

/* EMAIL VIEW */
.email-view { flex: 1; overflow-y: auto; padding: 24px 32px; display: none; }
.email-view.visible { display: block; }
.email-view-header { margin-bottom: 24px; }
.email-view-subject { font-size: 22px; font-weight: 400; margin-bottom: 16px; display: flex; align-items: center; gap: 12px; }
.email-label { font-size: 12px; background: var(--primary-light); color: var(--primary); padding: 2px 10px; border-radius: 12px; }
.email-meta { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 24px; }
.email-meta-avatar { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 15px; font-weight: 500; flex-shrink: 0; }
.email-meta-info { flex: 1; }
.email-sender { font-weight: 500; font-size: 14px; }
.email-sender span { font-weight: 400; color: var(--text-secondary); }
.email-date { font-size: 12px; color: var(--text-secondary); margin-top: 2px; }
.email-body { font-size: 14px; line-height: 1.7; color: var(--text); white-space: pre-line; max-width: 680px; }

/* REPLY BOX */
.reply-box { border: 1px solid var(--border); border-radius: 12px; margin-top: 32px; max-width: 680px; overflow: hidden; }
.reply-box-header { padding: 12px 16px; font-size: 13px; color: var(--text-secondary); }
.reply-box-header span { color: var(--text); font-weight: 500; }
.reply-area { padding: 12px 16px; min-height: 100px; font-size: 14px; outline: none; color: var(--text); font-family: 'Google Sans', sans-serif; }
.reply-actions { display: flex; align-items: center; padding: 8px 16px; gap: 8px; border-top: 1px solid var(--border); }
.btn-send { background: var(--primary); color: white; border: none; border-radius: 4px; padding: 8px 20px; font-size: 14px; font-family: 'Google Sans'; font-weight: 500; cursor: pointer; transition: background 0.15s; }
.btn-send:hover { background: #1557b0; }

/* COMPOSE MODAL */
.compose-modal { position: fixed; bottom: 0; right: 32px; width: 550px; background: white; border-radius: 12px 12px 0 0; box-shadow: 0 8px 30px rgba(0,0,0,0.25); z-index: 1000; display: none; }
.compose-modal.visible { display: block; }
.compose-header { background: #404040; color: white; padding: 10px 16px; border-radius: 12px 12px 0 0; display: flex; align-items: center; cursor: pointer; }
.compose-header span { font-size: 14px; font-weight: 500; flex: 1; font-family: 'Google Sans'; }
.compose-header .icon-btn { color: white; width: 28px; height: 28px; }
.compose-field { display: flex; align-items: center; padding: 4px 16px; border-bottom: 1px solid var(--border); }
.compose-field label { font-size: 13px; color: var(--text-secondary); width: 50px; }
.compose-field input { flex: 1; border: none; padding: 8px 0; font-size: 14px; font-family: 'Google Sans'; outline: none; color: var(--text); }
.compose-body { padding: 12px 16px; min-height: 180px; font-size: 14px; outline: none; font-family: 'Google Sans'; }
.compose-footer { display: flex; align-items: center; padding: 8px 12px; border-top: 1px solid var(--border); gap: 4px; }

/* UNREAD DOT */
.unread-dot { width: 8px; height: 8px; background: var(--primary); border-radius: 50%; flex-shrink: 0; }

@media (max-width: 768px) {
  nav { display: none; }
  .row-from { width: 100px; }
}
</style>
</head>
<body>

<header>
  <div class="logo">
    <span class="material-icons icon-btn" style="color:#5f6368">menu</span>
    <div class="logo-text" style="margin-left:4px">
      <span>G</span><span>m</span><span>a</span><span>i</span><span>l</span>
    </div>
  </div>

  <div class="search-bar">
    <span class="material-icons search-icon">search</span>
    <input type="text" placeholder="Rechercher dans les e-mails">
    <span class="material-icons search-filter">tune</span>
  </div>

  <div class="header-actions">
    <button class="icon-btn"><span class="material-icons">help_outline</span></button>
    <button class="icon-btn"><span class="material-icons">settings</span></button>
    <button class="icon-btn"><span class="material-icons">apps</span></button>
    <div class="avatar"><?= $user['avatar'] ?></div>
  </div>
</header>

<div class="app-body">
  <nav>
    <a href="?compose=1" class="compose-btn">
      <span class="material-icons">edit</span>
      Nouveau message
    </a>

    <a href="?" class="nav-item <?= !$active_tab || $active_tab=='primary' ? 'active' : '' ?>">
      <span class="material-icons">inbox</span>
      Boîte de réception
      <span class="nav-badge">5</span>
    </a>
    <a href="?tab=starred" class="nav-item <?= $active_tab=='starred' ? 'active' : '' ?>">
      <span class="material-icons">star_outline</span>
      Suivis
    </a>
    <a href="?tab=sent" class="nav-item">
      <span class="material-icons">send</span>
      Messages envoyés
    </a>
    <a href="?tab=drafts" class="nav-item">
      <span class="material-icons">description</span>
      Brouillons
      <span class="nav-badge">2</span>
    </a>
    <a href="#" class="nav-item" onclick="this.querySelector('.material-icons').textContent='expand_less'">
      <span class="material-icons">expand_more</span>
      Plus
    </a>

    <div class="nav-divider"></div>
    <div class="nav-section">LIBELLÉS</div>
    <a href="#" class="nav-item">
      <span class="material-icons" style="color:#e67c73">label</span>
      Personnel
    </a>
    <a href="#" class="nav-item">
      <span class="material-icons" style="color:#4285f4">label</span>
      Travail
    </a>
    <a href="#" class="nav-item">
      <span class="material-icons" style="color:#33b679">label</span>
      Newsletters
    </a>
    <a href="#" class="nav-item">
      <span class="material-icons">add</span>
      Nouveau libellé
    </a>
  </nav>

  <main>
    <?php if ($active_email): ?>
      <?php
        $email = null;
        foreach ($emails as $e) { if ($e['id'] == $active_email) { $email = $e; break; } }
      ?>
      <?php if ($email): ?>
      <div class="toolbar">
        <a href="?" class="icon-btn" title="Retour"><span class="material-icons">arrow_back</span></a>
        <button class="icon-btn" title="Archiver"><span class="material-icons">archive</span></button>
        <button class="icon-btn" title="Signaler comme spam"><span class="material-icons">report</span></button>
        <button class="icon-btn" title="Supprimer"><span class="material-icons">delete</span></button>
        <div class="toolbar-divider"></div>
        <button class="icon-btn" title="Lu/Non-lu"><span class="material-icons">mark_email_unread</span></button>
        <button class="icon-btn" title="Rappel"><span class="material-icons">watch_later</span></button>
        <button class="icon-btn" title="Déplacer"><span class="material-icons">drive_file_move</span></button>
        <button class="icon-btn" title="Étiquettes"><span class="material-icons">label</span></button>
        <button class="icon-btn" title="Plus"><span class="material-icons">more_vert</span></button>
        <div class="page-info">
          <span>1 sur <?= count($emails) ?></span>
          <button class="icon-btn"><span class="material-icons">chevron_left</span></button>
          <button class="icon-btn"><span class="material-icons">chevron_right</span></button>
        </div>
      </div>

      <div class="email-view visible">
        <div class="email-view-header">
          <div class="email-view-subject">
            <?= htmlspecialchars($email['subject']) ?>
            <span class="email-label"><?= $email['label'] ?></span>
          </div>

          <div class="email-meta">
            <div class="email-meta-avatar" style="background:<?= getAvatarColor($email['from']) ?>">
              <?= getInitials($email['from']) ?>
            </div>
            <div class="email-meta-info">
              <div class="email-sender">
                <?= htmlspecialchars($email['from']) ?>
                <span>&lt;<?= htmlspecialchars($email['email']) ?>&gt;</span>
              </div>
              <div class="email-date">
                <?= $email['date'] ?> · à moi
                <span class="material-icons" style="font-size:14px;vertical-align:middle;color:var(--text-secondary)">arrow_drop_down</span>
              </div>
            </div>
            <button class="icon-btn"><span class="material-icons">star<?= $email['starred'] ? '' : '_outline' ?></span></button>
            <button class="icon-btn"><span class="material-icons">reply</span></button>
            <button class="icon-btn"><span class="material-icons">more_vert</span></button>
          </div>
        </div>

        <div class="email-body"><?= htmlspecialchars($email['body']) ?></div>

        <div class="reply-box">
          <div class="reply-box-header">
            Répondre à <span><?= htmlspecialchars($email['from']) ?></span>
          </div>
          <div class="reply-area" contenteditable="true"></div>
          <div class="reply-actions">
            <button class="btn-send">Envoyer</button>
            <button class="icon-btn"><span class="material-icons">format_bold</span></button>
            <button class="icon-btn"><span class="material-icons">attach_file</span></button>
            <button class="icon-btn"><span class="material-icons">insert_emoticon</span></button>
            <button class="icon-btn" style="margin-left:auto"><span class="material-icons">delete</span></button>
          </div>
        </div>
      </div>
      <?php endif; ?>

    <?php else: ?>
    <div class="tabs">
      <a class="tab <?= $active_tab=='primary' ? 'active' : '' ?>" href="?tab=primary">
        <span class="material-icons">inbox</span>
        Principale
        <span class="tab-badge">3</span>
      </a>
      <a class="tab <?= $active_tab=='social' ? 'active' : '' ?>" href="?tab=social">
        <span class="material-icons">people</span>
        Réseaux sociaux
      </a>
      <a class="tab <?= $active_tab=='updates' ? 'active' : '' ?>" href="?tab=updates">
        <span class="material-icons">notifications</span>
        Notifications
      </a>
    </div>

    <div class="toolbar">
      <input type="checkbox" style="width:16px;height:16px;margin:0 12px;cursor:pointer">
      <button class="icon-btn"><span class="material-icons">arrow_drop_down</span></button>
      <button class="icon-btn" title="Actualiser"><span class="material-icons">refresh</span></button>
      <button class="icon-btn" title="Plus"><span class="material-icons">more_vert</span></button>
      <div class="page-info">
        <span>1–<?= count($emails) ?> sur <?= count($emails) ?></span>
        <button class="icon-btn"><span class="material-icons">chevron_left</span></button>
        <button class="icon-btn"><span class="material-icons">chevron_right</span></button>
      </div>
    </div>

    <div class="email-list">
      <?php foreach ($emails as $email):
        if ($active_tab == 'primary' && $email['label'] != 'primary') continue;
        if ($active_tab == 'social' && $email['label'] != 'social') continue;
        if ($active_tab == 'updates' && $email['label'] != 'updates') continue;
      ?>
      <a href="?id=<?= $email['id'] ?>&tab=<?= $active_tab ?>"
         class="email-row <?= !$email['read'] ? 'unread' : '' ?>"
         style="text-decoration:none;color:inherit">
        <div class="row-check">
          <input type="checkbox" onclick="event.stopPropagation()">
        </div>
        <div class="row-star">
          <span class="material-icons <?= $email['starred'] ? 'starred' : '' ?>">
            <?= $email['starred'] ? 'star' : 'star_outline' ?>
          </span>
        </div>
        <div class="row-avatar" style="background:<?= getAvatarColor($email['from']) ?>">
          <?= getInitials($email['from']) ?>
        </div>
        <div class="row-from"><?= htmlspecialchars($email['from']) ?></div>
        <div class="row-content">
          <span class="row-subject"><?= htmlspecialchars($email['subject']) ?></span>
          <span class="row-preview"><?= htmlspecialchars($email['preview']) ?></span>
        </div>
        <div class="row-time"><?= $email['time'] ?></div>
      </a>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </main>
</div>

<!-- COMPOSE MODAL -->
<div class="compose-modal <?= $compose ? 'visible' : '' ?>" id="composeModal">
  <div class="compose-header" onclick="toggleCompose()">
    <span>Nouveau message</span>
    <button class="icon-btn" onclick="event.stopPropagation();toggleMinimize()"><span class="material-icons">remove</span></button>
    <button class="icon-btn" onclick="event.stopPropagation();toggleFullscreen()"><span class="material-icons">open_in_full</span></button>
    <button class="icon-btn" onclick="event.stopPropagation();closeCompose()"><span class="material-icons">close</span></button>
  </div>
  <div class="compose-field">
    <label>À</label>
    <input type="email" placeholder="">
  </div>
  <div class="compose-field">
    <label>Objet</label>
    <input type="text" placeholder="">
  </div>
  <div class="compose-body" contenteditable="true"></div>
  <div class="compose-footer">
    <button class="btn-send">Envoyer</button>
    <button class="icon-btn"><span class="material-icons">format_bold</span></button>
    <button class="icon-btn"><span class="material-icons">attach_file</span></button>
    <button class="icon-btn"><span class="material-icons">insert_link</span></button>
    <button class="icon-btn"><span class="material-icons">insert_emoticon</span></button>
    <button class="icon-btn"><span class="material-icons">insert_drive_file</span></button>
    <button class="icon-btn" style="margin-left:auto"><span class="material-icons">more_vert</span></button>
    <button class="icon-btn" onclick="closeCompose()"><span class="material-icons">delete</span></button>
  </div>
</div>

<script>
function toggleCompose() {}
function toggleMinimize() {
  const body = document.querySelector('.compose-modal > *:not(.compose-header)');
}
function toggleFullscreen() {}
function closeCompose() {
  document.getElementById('composeModal').classList.remove('visible');
  history.replaceState(null,'',location.pathname + '<?= $active_tab ? "?tab=$active_tab" : "" ?>');
}
// Star toggle without navigation
document.querySelectorAll('.row-star').forEach(star => {
  star.addEventListener('click', e => {
    e.preventDefault();
    const icon = star.querySelector('.material-icons');
    if (icon.textContent === 'star') {
      icon.textContent = 'star_outline';
      icon.classList.remove('starred');
    } else {
      icon.textContent = 'star';
      icon.classList.add('starred');
    }
  });
});
</script>
</body>
</html>
