<?php
// Location to store all the SQL statements that are used
// SQL Constants
// SQLite specific sql
const SQLITE_BUILD_MATERIALS = 
        "select 
            m.typeID as itemID, bt.typeName as itemName, t.typeID as typeID, 
            t.typeName as typeName, m.quantity as quantity, 'Mineral' as Type
	from invTypes t
            inner join invTypeMaterials m on m.materialTypeID = t.typeID
            inner join invTypes bt on m.typeID = bt.typeID
        where m.typeID = ?
        union
        select 
            b.productTypeID as itemID, bt.typeName as itemName, t.typeID as typeID, 
            t.typeName as typeName, r.quantity as quantity, 
            case 
                when g.categoryID = 16 then 'Skill' 
		when g.categoryID = 4 then 'Mineral'
		else 'Material' 
            end as Type
	from ramTypeRequirements r
            inner join invBlueprintTypes b on b.blueprintTypeID = r.typeID
            inner join invTypes t on r.requiredTypeID = t.typeID
            inner join invGroups g on g.groupID = t.groupID
            inner join invTypes bt on bt.typeID = b.productTypeID
	where 
            r.activityID = 1
            and b.productTypeID = ?";

// MySQL specific
const SQL_BUILD_MATERIALS = 
        "select itemID, itemName, typeID, typeName, quantity, Type
         from vBuildMaterials
         where itemID = ?";
const SQL_ITEM_NAME =
        "select typeName
         from vItems
         where typeID = ?";
const SQL_FIND_ITEM_NAME =
        "select typeName as label, typeID as value
         from vItems
         where typeName like ?";