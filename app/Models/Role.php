<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'description',
        'permissions',
        'is_active',
    ];

    protected $casts = [
        'permissions' => 'array',
        'is_active' => 'boolean',
    ];

    // Relations
    public function agents()
    {
        return $this->hasMany(Agent::class);
    }

    // Méthodes utilitaires
    public function hasPermission($permission)
    {
        return in_array($permission, $this->permissions ?? []);
    }

    public function grantPermission($permission)
    {
        $permissions = $this->permissions ?? [];
        if (!in_array($permission, $permissions)) {
            $permissions[] = $permission;
            $this->permissions = $permissions;
            $this->save();
        }
    }

    public function revokePermission($permission)
    {
        $permissions = $this->permissions ?? [];
        $this->permissions = array_values(array_diff($permissions, [$permission]));
        $this->save();
    }

    public function syncPermissions(array $permissions)
    {
        $this->permissions = $permissions;
        $this->save();
    }

    // Permissions disponibles dans le système
    public static function getAvailablePermissions()
    {
        return [
            // Dashboard
            'dashboard.view' => 'Accéder au tableau de bord',

            // Profil utilisateur
            'profile.view' => 'Voir son profil',
            'profile.edit' => 'Modifier son profil',

            // Directions
            'directions.view' => 'Voir les directions',
            'directions.create' => 'Créer une direction',
            'directions.edit' => 'Modifier une direction',
            'directions.delete' => 'Supprimer une direction',
            'directions.toggle-status' => 'Activer/Désactiver une direction',

            // Services
            'services.view' => 'Voir les services',
            'services.create' => 'Créer un service',
            'services.edit' => 'Modifier un service',
            'services.delete' => 'Supprimer un service',
            'services.toggle-status' => 'Activer/Désactiver un service',

            // Sous-directions
            'sous-directions.view' => 'Voir les sous-directions',
            'sous-directions.create' => 'Créer une sous-direction',
            'sous-directions.edit' => 'Modifier une sous-direction',
            'sous-directions.delete' => 'Supprimer une sous-direction',
            'sous-directions.toggle-status' => 'Activer/Désactiver une sous-direction',

            // Agents
            'agents.view' => 'Voir les agents',
            'agents.create' => 'Créer un agent',
            'agents.edit' => 'Modifier un agent',
            'agents.delete' => 'Supprimer un agent',
            'agents.export' => 'Exporter les agents',
            'agents.identification' => 'Liste d\'identification',
            'agents.retraites' => 'Liste des retraités',
            'agents.malades' => 'Liste des malades',
            'agents.demissions' => 'Liste des démissions',
            'agents.revocations' => 'Liste des révocations',
            'agents.disponibilites' => 'Liste des disponibilités',
            'agents.detachements' => 'Liste des détachements',
            'agents.mutations' => 'Liste des mutations',
            'agents.reintegrations' => 'Liste des réintégrations',
            'agents.missions' => 'Liste des missions',
            'agents.deces' => 'Liste des décès',

            // Présences
            'presences.view' => 'Voir les présences',
            'presences.daily' => 'Voir la présence quotidienne',
            'presences.create' => 'Créer une présence',
            'presences.edit' => 'Modifier une présence',
            'presences.delete' => 'Supprimer une présence',
            'presences.export' => 'Exporter les présences',

            // Congés
            'conges.view' => 'Voir les congés',
            'conges.dashboard' => 'Dashboard congés',
            'conges.create' => 'Créer un congé',
            'conges.edit' => 'Modifier un congé',
            'conges.delete' => 'Supprimer un congé',
            'conges.approbation-directeur' => 'Approuver en tant que directeur',
            'conges.validation-sd' => 'Valider en tant que Sous Directeur',
            'conges.validation-drh' => 'Valider en tant que DRH',
            'conges.mes-conges' => 'Voir mes congés',

            // Cotations
            'cotations.view' => 'Voir les cotations',
            'cotations.dashboard' => 'Dashboard cotations',
            'cotations.create' => 'Créer une cotation',
            'cotations.edit' => 'Modifier une cotation',
            'cotations.delete' => 'Supprimer une cotation',
            'cotations.generate' => 'Générer automatiquement',

            // Rôles et Permissions
            'roles.view' => 'Voir les rôles',
            'roles.edit' => 'Modifier les rôles',
            'roles.permissions' => 'Gérer les permissions',

            // Stock
            'stocks.view' => 'Voir les stocks',
            'stocks.dashboard' => 'Dashboard stock',
            'stocks.create' => 'Créer un stock',
            'stocks.edit' => 'Modifier un stock',
            'stocks.delete' => 'Supprimer un stock',
            'stocks.ajouter' => 'Ajouter au stock',
            'stocks.retirer' => 'Retirer du stock',
            'stocks.mouvements' => 'Voir les mouvements de stock',

            // Demandes de fournitures
            'demandes-fournitures.view' => 'Voir les demandes de fournitures',
            'demandes-fournitures.dashboard' => 'Dashboard fournitures',
            'demandes-fournitures.create' => 'Créer une demande',
            'demandes-fournitures.edit' => 'Modifier une demande',
            'demandes-fournitures.delete' => 'Supprimer une demande',
            'demandes-fournitures.approver' => 'Approuver une demande',
            'demandes-fournitures.livrer' => 'Livrer une demande',
            'demandes-fournitures.mes-demandes' => 'Mes demandes',

            // Véhicules
            'vehicules.view' => 'Voir les véhicules',
            'vehicules.dashboard' => 'Dashboard véhicules',
            'vehicules.create' => 'Créer un véhicule',
            'vehicules.edit' => 'Modifier un véhicule',
            'vehicules.delete' => 'Supprimer un véhicule',
            'vehicules.maintenance' => 'Voir/ajouter une maintenance',

            // Chauffeurs
            'chauffeurs.view' => 'Voir les chauffeurs',
            'chauffeurs.create' => 'Créer un chauffeur',
            'chauffeurs.edit' => 'Modifier un chauffeur',
            'chauffeurs.delete' => 'Supprimer un chauffeur',

            // Demandes de véhicules
            'demandes-vehicules.view' => 'Voir les demandes de véhicules',
            'demandes-vehicules.dashboard' => 'Dashboard demandes véhicules',
            'demandes-vehicules.create' => 'Créer une demande véhicule',
            'demandes-vehicules.edit' => 'Modifier une demande véhicule',
            'demandes-vehicules.delete' => 'Supprimer une demande véhicule',
            'demandes-vehicules.approver' => 'Approuver une demande véhicule',
            'demandes-vehicules.affecter' => 'Affecter un véhicule',
            'demandes-vehicules.mes-demandes' => 'Mes demandes véhicules',
            'demandes-vehicules.demarrer' => 'Démarrer une mission véhicule',
            'demandes-vehicules.terminer' => 'Terminer une mission véhicule',
            'demandes-vehicules.get-affectation' => 'Voir les informations d\'affectation',

            // Paiements
            'paiements.view' => 'Voir les paiements',
            'paiements.dashboard' => 'Dashboard paiements',
            'paiements.create' => 'Créer un paiement',
            'paiements.edit' => 'Modifier un paiement',
            'paiements.delete' => 'Supprimer un paiement',
            'paiements.valider' => 'Valider un paiement',
            'paiements.payer' => 'Effectuer un paiement',
            'paiements.fiches-paie' => 'Voir les fiches de paie',
            'paiements.mes-paiements' => 'Mes paiements',
            'paiements.calculer-salaire' => 'Calculer salaire',
            'paiements.calculer-decompte-final' => 'Calculer décompte final',

            // Courriers
            'courriers.view' => 'Voir les courriers',
            'courriers.dashboard' => 'Dashboard courriers',
            'courriers.create' => 'Créer un courrier',
            'courriers.edit' => 'Modifier un courrier',
            'courriers.delete' => 'Supprimer un courrier',
            'courriers.traiter' => 'Traiter un courrier',
            'courriers.archiver' => 'Archiver un courrier',
            'courriers.entrants' => 'Voir courriers entrants',
            'courriers.sortants' => 'Voir courriers sortants',
            'courriers.internes' => 'Voir courriers internes',
            'courriers.non-traites' => 'Voir courriers non traités',
            'courriers.archives' => 'Voir archives de courriers',
            'courriers.ajouter-document' => 'Ajouter un document à un courrier',
            'courriers.supprimer-document' => 'Supprimer un document d\'un courrier',

            // Visiteurs
            'visitors.view' => 'Voir les visiteurs',
            'visitors.create' => 'Ajouter un visiteur',
            'visitors.edit' => 'Modifier un visiteur',
            'visitors.delete' => 'Supprimer un visiteur',

            // Valves
            'valves.view' => 'Voir les valves',
            'valves.dashboard' => 'Dashboard valves',
            'valves.create' => 'Créer un communiqué',
            'valves.edit' => 'Modifier un communiqué',
            'valves.delete' => 'Supprimer un communiqué',
        ];
    }

    // Rôles prédéfinis
    public static function getDefaultRoles()
    {
        return [
            'directeur' => [
                'name' => 'directeur',
                'display_name' => 'Directeur',
                'description' => 'Directeur avec pleins pouvoirs',
                'permissions' => [],
            ],
            'sous-directeur' => [
                'name' => 'sous-directeur',
                'display_name' => 'Sous-Directeur',
                'description' => 'Sous-directeur avec permissions étendues',
                'permissions' => [],
            ],
            'assistant' => [
                'name' => 'assistant',
                'display_name' => 'Assistant',
                'description' => 'Assistant avec permissions limitées',
                'permissions' => [],
            ],
            'secretaire' => [
                'name' => 'secretaire',
                'display_name' => 'Secrétaire',
                'description' => 'Secrétaire avec accès au courrier et visiteurs',
                'permissions' => [],
            ],
            'chef-service' => [
                'name' => 'chef-service',
                'display_name' => 'Chef de Service',
                'description' => 'Chef de service avec permissions de supervision',
                'permissions' => [],
            ],
            'chef-s-principal' => [
                'name' => 'chef-s-principal',
                'display_name' => 'Chef de Service Principal',
                'description' => 'Chef de service principal avec permissions étendues',
                'permissions' => [],
            ],
            'collaborateur' => [
                'name' => 'collaborateur',
                'display_name' => 'Collaborateur',
                'description' => 'Collaborateur avec accès de base',
                'permissions' => [],
            ],
            'maitrise' => [
                'name' => 'maitrise',
                'display_name' => 'Maîtrise',
                'description' => 'Agent de maîtrise avec accès intermédiaire',
                'permissions' => [],
            ],
            'execution' => [
                'name' => 'execution',
                'display_name' => 'Exécution',
                'description' => 'Agent d\'exécution avec accès minimal',
                'permissions' => [],
            ],
        ];
    }

    public function getBadgeClass()
    {
        return match($this->name) {
            'directeur' => 'bg-red-100 text-red-800',
            'sous-directeur' => 'bg-purple-100 text-purple-800',
            'assistant' => 'bg-indigo-100 text-indigo-800',
            'secretaire' => 'bg-blue-100 text-blue-800',
            'chef-service' => 'bg-green-100 text-green-800',
            'chef-s-principal' => 'bg-emerald-100 text-emerald-800',
            'collaborateur' => 'bg-yellow-100 text-yellow-800',
            'maitrise' => 'bg-orange-100 text-orange-800',
            'execution' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getIcon()
    {
        return match($this->name) {
            'directeur' => 'bx-crown',
            'sous-directeur' => 'bx-shield',
            'assistant' => 'bx-user-voice',
            'secretaire' => 'bx-edit',
            'chef-service' => 'bx-user-check',
            'chef-s-principal' => 'bx-user-plus',
            'collaborateur' => 'bx-group',
            'maitrise' => 'bx-wrench',
            'execution' => 'bx-user',
            default => 'bx-user'
        };
    }
}
