<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Décision de Congé</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            margin: 50px;
        }
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .mb-2 { margin-bottom: 0.5rem; }
        .mb-4 { margin-bottom: 1rem; }
        .signature-block {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        .bold { font-weight: bold; }
    </style>
</head>
<body>

    <div class="text-left mb-2">
        <div>ANADEC</div>
        <div>DIRECTION DES RESSOURCES HUMAINES</div>
        <div>SOUS-DIRECTION GESTION DU PERSONNEL</div>
    </div>

    @if ($conge->type == 'annuel')
        <h3 class="text-center mb-4">DECISION DE CONGE DE CIRCONSTANCE</h3>
    @else
        <h3 class="text-center mb-4">DECISION DE CONGE DE RECONSTITUTION <br> EXERCICE {{ $conge->exercice ?? "" }}</h3>
    @endif


    <p><span class="bold">NOM ET POSTNOM</span> : {{ $conge->agent->nom }}</p>
    <p><span class="bold">GRADE</span> : {{ $conge->agent->grade }}</p>
    <p><span class="bold">MOTIF</span> : {{ $conge->motif }}</p>
    <p><span class="bold">DUREE</span> : {{ $conge->duree }} JRS</p>
    <p>
        <span class="bold">Allant du</span> {{ \Carbon\Carbon::parse($conge->date_debut)->format('l d/m/Y') }}
        <span class="bold">au</span> {{ \Carbon\Carbon::parse($conge->date_fin)->format('l d/m/Y') }}
    </p>
    <p><span class="bold">DATE DE REPRISE</span> : {{ \Carbon\Carbon::parse($conge->date_reprise)->format('l d/m/Y') }}</p>

    <div class="signature-block">
        <div style="float: left">
            <p class="bold">NDUTE YANGO</p>
            <p>Resp. S/D Gestion du personnel</p>
        </div>
        <div style="float: right">
            <p class="bold">KATEMBUA KASHALA</p>
            <p>Directeur des Ressources Humaines a.i</p>

            <p class="mt-4" style="text-align: right; padding-top: 200px">Fait à Kinshasa, le {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>
    </div>

</body>
</html>
