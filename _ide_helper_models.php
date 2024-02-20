<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\DocumentModel
 *
 * @property int $id
 * @property string $name
 * @property string $nomor_dokumen
 * @property string $directory
 * @property string $give_access_to
 * @property string $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentModel whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentModel whereDirectory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentModel whereGiveAccessTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentModel whereNomorDokumen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentModel whereUpdatedAt($value)
 */
	class DocumentModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PasswordResetTokenModel
 *
 * @property string $email
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordResetTokenModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordResetTokenModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordResetTokenModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordResetTokenModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordResetTokenModel whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordResetTokenModel whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PasswordResetTokenModel whereUpdatedAt($value)
 */
	class PasswordResetTokenModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RegisterInvitationModel
 *
 * @property int $id
 * @property string $email
 * @property int $role
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterInvitationModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterInvitationModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterInvitationModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterInvitationModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterInvitationModel whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterInvitationModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterInvitationModel whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterInvitationModel whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RegisterInvitationModel whereUpdatedAt($value)
 */
	class RegisterInvitationModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RoleModel
 *
 * @property int $id
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RoleModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleModel whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleModel whereUpdatedAt($value)
 */
	class RoleModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property int|null $status
 * @property int|null $role
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $profile_pict
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

