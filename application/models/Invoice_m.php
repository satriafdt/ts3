<?php
class Invoice_m extends CI_Model
{


    function Get_allDataInvoice_bengkel()
    {

        $query = "select i.id,
        i.invoice_no,
        i.status_invoice,
        s.service_no,
        us.name as bengkel_name,
        date(i.invoice_date) as invoice_date,
        i.amount
        from invoice i
        left join users us on i.user_request = us.id
        left join service s on i.service_id = s.id 
        where i.ms_ti_id =1 and i.status_invoice ='Request'";

        return $this->db->query($query);
    }


    function Get_allDataInvoice_Client()
    {

        $query = "select  i.id,
        i.invoice_no,
        i.status_invoice,
        s.service_no,
        s.asset_id,
        as2.client_id,
        us.name as bengkel_name,
        date(i.invoice_date) as invoice_date,
        i.img_invoice,
        i.amount
        from invoice i
        left join users us on i.user_request = us.id
        left join service s on i.service_id = s.id 
        left join assets_service as2 on s.asset_id = as2.id
        where i.ms_ti_id =2 and i.status_invoice ='Request'";

        return $this->db->query($query);
    }



    function Get_allDataInvoice_bengkel_d($id)
    {

        $query = "select i.id,
        i.invoice_no,
        i.status_invoice,
        s.service_no,
        us.name as bengkel_name,
        date(i.invoice_date) as invoice_date,
        i.amount
        from invoice i
        left join users us on i.user_request = us.id
        left join service s on i.service_id = s.id 
        where i.ms_ti_id =1 and i.status_invoice ='Request' and i.id='$id'";

        return $this->db->query($query);
    }
}
