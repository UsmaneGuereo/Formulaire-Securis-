├── LICENSE
├── Makefile
├── README.md
├── data
│   └── raw
│       └── Healthcare-Diabetes.csv
│
├── reports
│   └── figures        <- Graphiques et chiffres générées à utiliser dans le rapport
│
├── setup.py           <- Rend le projet pip installable (pip install -e .) afin que src puisse être importé
├── src                <- Code source à utiliser dans ce projet.
│   ├── main.py        <- Code source source pour tester notre projet
│   │
│   ├── data           <- Scripts pour télécharger ou générer des données
│   │   └── diabete_data.py
│   │
│   ├── features       <- Scripts pour transformer les données brutes en caractéristiques à modéliser
│   │   └── build_features.py
│   │
│   ├── models         <- Scripts pour entraîner des modèles, puis utiliser ces modèles entraînés 
│   │   │                 pour faire des prédictions
│   │   ├── model_decision_tree.py
│   │   ├── model_knn.py
│   │   ├── model_random_forest.py
│   │   └── model_svc.py
│   │



# Formulaire-Securisé
Creation d'un formulaire securisé avec HTML Bootstrap JavaScript et PHP
│   └── visualization  <- Scripts pour créer des visualisations exploratoires et axées sur les résultats
│       └── visualize.py
│
├── tox.ini            <- tox avec les paramètres d’exécution de tox ; Voir tox.readthedocs.io
|
└── Rapport.pdf        <- Rapport de notre projet
