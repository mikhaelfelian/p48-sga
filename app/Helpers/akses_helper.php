<?php
/**
 * Description of Akses Helper
 *
 * @author mike
 */

# Hak SuperAdmin
function hakSA() {
    $ionAuth    = new \IonAuth\Libraries\IonAuth();
    $ID         = $ionAuth->user()->row();
    $IDGrup     = $ionAuth->getUsersGroups($ID->id)->getRow();
       
    if ($IDGrup->name == 'superadmin') {
        return TRUE;
    } else {
        return FALSE;
    }
}

# Hak Owner
function hakOwner() {
    $ionAuth    = new \IonAuth\Libraries\IonAuth();
    $ID         = $ionAuth->user()->row();
    $IDGrup     = $ionAuth->getUsersGroups($ID->id)->getRow();
       
    if ($IDGrup->name == 'owner') {
        return TRUE;
    } else {
        return FALSE;
    }
}

# Hak Owner
function hakOwner2() {
    $ionAuth    = new \IonAuth\Libraries\IonAuth();
    $ID         = $ionAuth->user()->row();
    $IDGrup     = $ionAuth->getUsersGroups($ID->id)->getRow();
       
    if ($IDGrup->name == 'owner2') {
        return TRUE;
    } else {
        return FALSE;
    }
}

# Hak Manager
function hakAdminM() {
    $ionAuth    = new \IonAuth\Libraries\IonAuth();
    $ID         = $ionAuth->user()->row();
    $IDGrup     = $ionAuth->getUsersGroups($ID->id)->getRow();
       
    if ($IDGrup->name == 'adminm') {
        return TRUE;
    } else {
        return FALSE;
    }
}

# Hak Staff
function hakAdmin() {
    $ionAuth    = new \IonAuth\Libraries\IonAuth();
    $ID         = $ionAuth->user()->row();
    $IDGrup     = $ionAuth->getUsersGroups($ID->id)->getRow();
       
    if ($IDGrup->name == 'admin') {
        return TRUE;
    } else {
        return FALSE;
    }
}

# Hak Purchasing
function hakPurchasing() {
    $ionAuth    = new \IonAuth\Libraries\IonAuth();
    $ID         = $ionAuth->user()->row();
    $IDGrup     = $ionAuth->getUsersGroups($ID->id)->getRow();
       
    if ($IDGrup->name == 'purchasing') {
        return TRUE;
    } else {
        return FALSE;
    }
}

# Hak Gudang
function hakGudang() {
    $ionAuth    = new \IonAuth\Libraries\IonAuth();
    $ID         = $ionAuth->user()->row();
    $IDGrup     = $ionAuth->getUsersGroups($ID->id)->getRow();
       
    if ($IDGrup->name == 'gudang') {
        return TRUE;
    } else {
        return FALSE;
    }
}

# Hak Sales
function hakSales() {
    $ionAuth    = new \IonAuth\Libraries\IonAuth();
    $ID         = $ionAuth->user()->row();
    $IDGrup     = $ionAuth->getUsersGroups($ID->id)->getRow();
       
    if ($IDGrup->name == 'sales') {
        return TRUE;
    } else {
        return FALSE;
    }
}

# Hak Teknisi
function hakTeknisi() {
    $ionAuth    = new \IonAuth\Libraries\IonAuth();
    $ID         = $ionAuth->user()->row();
    $IDGrup     = $ionAuth->getUsersGroups($ID->id)->getRow();
       
    if ($IDGrup->name == 'teknisi') {
        return TRUE;
    } else {
        return FALSE;
    }
}
?>
