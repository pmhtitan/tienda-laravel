<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roles',
        'session_user',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* Relationships */

    // Uno a muchos
    public function pedidos(){
        return $this->hasMany('App\Models\Pedido');
    }

    // Uno a muchos
    public function datosFacturacion(){
        return $this->hasMany('App\Models\DatosFacturacion');
    }

    // One to One
    public function carrito(){
        return $this->hasOne('App\Models\Carrito', 'usuario_id'); // y esto
    }

    // Funciones custom
    public function statsCarrito($carrito, float $shippingPrice){
        $stats = array(
            'products' => 0,
            'items' => 0,
            'subtotal' => 0,
            'shippingPrice' => 0,
            'total' => 0,
        );

        if(isset($carrito)){
            $stats['products'] = count($carrito);

            foreach($carrito as $producto){
                $stats['subtotal'] += $producto['precio'] * $producto['unidades'];
                $stats['items'] += $producto['unidades'];
            } 
        }
        $stats['total'] = $stats['subtotal'] + $shippingPrice;
        $stats['shippingPrice'] = $shippingPrice;

        return $stats;
    }

}
