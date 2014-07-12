<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Equations
 *
 * @author Gallica
 */
class Equations {

    public function industrySlotCost() {
        
        // base_cost = sum(Each material * adjustedPrice ( crest:/market/prices/ ))
        // ModCost = {
        // Manf: base_cost * # of runs
        // Research: sumTotal = sum(base_cost * levelMultiplier
        // Copy: bose_cost * 0.02 * runsperCopy * # of runs
        // Invention/RE: base_cost * 0.02
        // }
        // ModCost2 = ModCost * costIndex ( crest:/industry/systems/ )
        // ModCost3 = ModCost2 * facilityBonus ( DB:ramAssemblyLineTypes )
        // Final Cost = ModCost3 * 0.10 ( tax for NPC station (faction related?) )
    }
    
    public function industryMEMod() {
        
        // Possible equation for Crius
        // numMatieral = ( me level * 0.01 ) * baseMaterial
    }
    
    public function industryTEMod () {
        
        // Possible equation for Crius
        // totTime = ( te level * 0.02 ) * baseBuildTime
    }
    
    public function reprocessYield () {
        
        // totMatYield = StationEquip 
        //              * ( 1 + Refining * 0.03 ) 
        //              * ( 1+ Refing Eff * 0.02 )
        //              * ( 1 + Ore Skill * 0.02 )
        //              * implantBonus
            
    }
   
}
