# QCM Kubernetes – Projet Laravel

Ce projet est une application de **QCM (Questions à Choix Multiples)** permettant de tester ses connaissances sur **Kubernetes**. Il a été développé avec **Laravel (PHP)**.

## Fonctionnalités

-   Interface simple pour répondre à des QCM sur Kubernetes
-   Base de données avec des questions préremplies
-   Système d’évaluation du niveau de l’utilisateur

---

## Installation

Voici les étapes pour installer et lancer le projet en local :

### 1. Cloner le dépôt

```bash
git clone https://github.com/Zohade/questions.git
cd questions
```

### 2. Installer les dépendances

```bash
composer install
```

### 3. Configurer

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Lancer la migration

```bash
php artisan migrate --seed
```

### 5. Lancer le server local

```bash
php artisan serve
```
