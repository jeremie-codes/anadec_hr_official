@extends('layouts.app')

@section('title', 'Modifier Demande - ANADEC RH')
@section('page-title', 'Modifier Demande de Fourniture')
@section('page-description', 'Modification de la demande de fourniture')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-yellow-50 to-orange-50">
            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                <i class="bx bx-edit mr-2 text-yellow-600"></i>
                Modifier la Demande de Fourniture
            </h3>
            <p class="text-sm text-gray-600">Modifiez les informations de votre demande</p>
        </div>

        <form method="POST" action="{{ route('demandes-fournitures.update', $demandeFourniture) }}" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Informations du demandeur -->
                <div class="space-y-6">
                    <div>
                        <label for="agent_id" class="block text-sm font-medium text-gray-700">Demandeur *</label>
                        <select name="agent_id" id="agent_id" required
                                class="mt-1 py-2 px-4 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-anadec-blue focus:border-anadec-blue">
                            <option value="">Sélectionnez un agent...</option>
                            @foreach($agents as $agent)
                                <option value="{{ $agent->id }}" {{ old('agent_id', $demandeFourniture->agent_id) == $agent->id ? 'selected' : '' }}>
                                    {{ $agent->full_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('agent_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="direction" class="block text-sm font-medium text-gray-700">Direction *</label>
                            <select name="direction" id="direction" required
                                    class="mt-1 py-2 px-4 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-anadec-blue focus:border-anadec-blue">
                                <option value="">Sélectionnez...</option>
                                @foreach($directions as $direction)
                                    <option value="{{ $direction->id }}" {{ old('direction', $demandeFourniture->direction->id) == $direction->id ? 'selected' : '' }}>
                                        {{ $direction->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('direction')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="service" class="block text-sm font-medium text-gray-700">Service *</label>
                            <select name="service" id="service" required
                                    class="mt-1 py-2 px-4 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-anadec-blue focus:border-anadec-blue">
                                <option value="">Sélectionnez...</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ old('service', $demandeFourniture->service->id) == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('service')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="besoin" class="block text-sm font-medium text-gray-700">Description du Besoin *</label>
                        <textarea name="besoin" id="besoin" rows="4" required
                                  class="mt-1 py-2 px-4 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-anadec-blue focus:border-anadec-blue"
                                  placeholder="Décrivez précisément votre besoin...">{{ old('besoin', $demandeFourniture->besoin) }}</textarea>
                        @error('besoin')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Détails de la demande -->
                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="quantite" class="block text-sm font-medium text-gray-700">Quantité *</label>
                            <input type="number" name="quantite" id="quantite" required min="1"
                                   value="{{ old('quantite', $demandeFourniture->quantite) }}"
                                   class="mt-1 py-2 px-4 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-anadec-blue focus:border-anadec-blue">
                            @error('quantite')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="unite" class="block text-sm font-medium text-gray-700">Unité *</label>
                            <select name="unite" id="unite" required
                                    class="mt-1 py-2 px-4 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-anadec-blue focus:border-anadec-blue">
                                <option value="">Sélectionnez...</option>
                                <option value="unité" {{ old('unite', $demandeFourniture->unite) == 'unité' ? 'selected' : '' }}>Unité</option>
                                <option value="pièce" {{ old('unite', $demandeFourniture->unite) == 'pièce' ? 'selected' : '' }}>Pièce</option>
                                <option value="boîte" {{ old('unite', $demandeFourniture->unite) == 'boîte' ? 'selected' : '' }}>Boîte</option>
                                <option value="paquet" {{ old('unite', $demandeFourniture->unite) == 'paquet' ? 'selected' : '' }}>Paquet</option>
                                <option value="kg" {{ old('unite', $demandeFourniture->unite) == 'kg' ? 'selected' : '' }}>Kilogramme</option>
                                <option value="litre" {{ old('unite', $demandeFourniture->unite) == 'litre' ? 'selected' : '' }}>Litre</option>
                                <option value="mètre" {{ old('unite', $demandeFourniture->unite) == 'mètre' ? 'selected' : '' }}>Mètre</option>
                                <option value="lot" {{ old('unite', $demandeFourniture->unite) == 'lot' ? 'selected' : '' }}>Lot</option>
                            </select>
                            @error('unite')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="urgence" class="block text-sm font-medium text-gray-700">Niveau d'Urgence *</label>
                        <select name="urgence" id="urgence" required
                                class="mt-1 py-2 px-4 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-anadec-blue focus:border-anadec-blue">
                            <option value="">Sélectionnez...</option>
                            <option value="faible" {{ old('urgence', $demandeFourniture->urgence) == 'faible' ? 'selected' : '' }}>Faible</option>
                            <option value="normale" {{ old('urgence', $demandeFourniture->urgence) == 'normale' ? 'selected' : '' }}>Normale</option>
                            <option value="elevee" {{ old('urgence', $demandeFourniture->urgence) == 'elevee' ? 'selected' : '' }}>Élevée</option>
                            <option value="critique" {{ old('urgence', $demandeFourniture->urgence) == 'critique' ? 'selected' : '' }}>Critique</option>
                        </select>
                        @error('urgence')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="date_besoin" class="block text-sm font-medium text-gray-700">Date Souhaitée de Livraison</label>
                        <input type="date" name="date_besoin" id="date_besoin"
                               value="{{ old('date_besoin', $demandeFourniture->date_besoin ? $demandeFourniture->date_besoin->format('Y-m-d') : '') }}"
                               min="{{ date('Y-m-d') }}"
                               class="mt-1 py-2 px-4 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-anadec-blue focus:border-anadec-blue">
                        @error('date_besoin')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="justification" class="block text-sm font-medium text-gray-700">Justification</label>
                        <textarea name="justification" id="justification" rows="3"
                                  class="mt-1 py-2 px-4 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-anadec-blue focus:border-anadec-blue"
                                  placeholder="Justifiez votre demande si nécessaire...">{{ old('justification', $demandeFourniture->justification) }}</textarea>
                        @error('justification')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Statut actuel -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-blue-900 mb-2 flex items-center">
                            <i class="bx bx-info-circle mr-2"></i>
                            Statut Actuel
                        </h4>
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $demandeFourniture->getStatutBadgeClass() }}">
                                <i class="bx {{ $demandeFourniture->getStatutIcon() }} mr-1"></i>
                                {{ $demandeFourniture->getStatutLabel() }}
                            </span>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $demandeFourniture->getUrgenceBadgeClass() }}">
                                <i class="bx {{ $demandeFourniture->getUrgenceIcon() }} mr-1"></i>
                                {{ $demandeFourniture->getUrgenceLabel() }}
                            </span>
                        </div>
                        <p class="text-xs text-blue-700 mt-2">
                            Demande créée le {{ $demandeFourniture->created_at->format('d/m/Y à H:i') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('demandes-fournitures.show', $demandeFourniture) }}"
                   class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">
                    Annuler
                </a>
                <button type="submit"
                        class="bg-anadec-blue text-white px-6 py-2 rounded-md hover:bg-anadec-dark-blue">
                    <i class="bx bx-save mr-2"></i>
                    Enregistrer les Modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
