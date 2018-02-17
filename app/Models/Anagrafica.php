<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 17 Feb 2018 09:31:37 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Anagrafica
 * 
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property string $email
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Anagrafica extends Eloquent
{
	protected $table = 'anagrafica';

	protected $fillable = [
		'nome',
		'cognome',
		'email'
	];
}
