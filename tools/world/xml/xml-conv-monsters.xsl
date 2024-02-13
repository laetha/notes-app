<xsl:stylesheet version="1.0" encoding="UTF-8" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output indent="yes"/>
  <xsl:strip-space elements="*"/>

  <!-- IDENTITY TRANSFORM TO COPY DOCUMENT AS IS -->
  <xsl:template match="@*|node()">
    <xsl:copy>
      <xsl:apply-templates select="@*|node()"/>
    </xsl:copy>
  </xsl:template>

  <xsl:template match="monster">
    <xsl:copy>
      <xsl:apply-templates select="title|monsterSize|monsterType|monsterAlignment|monsterAc|monsterHp|monsterSpeed|monsterStr|monsterDex|monsterCon|monsterInt|monsterWis|monsterCha|monsterSave|monsterSkill|monsterResist|monsterVulnerable|monsterImmune|monsterConditionImmune|monsterSenses|monsterPassive|monsterLanguages|monsterCr|monsterReaction"/>
        <xsl:element name="type">
          <xsl:text>monster</xsl:text>
        </xsl:element>

        <xsl:for-each select="trait">
          <xsl:variable name="pos" select="position()"/>
          <xsl:element name="monsterTrait{$pos}">
            <xsl:value-of select="name" />
            <xsl:text> &#xa;</xsl:text>
            <xsl:for-each select="text">
                <xsl:value-of select="."/>
                <xsl:if test="position() != last()">
                   <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                   <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                   <xsl:text> &#xa;&#xa;</xsl:text>
                </xsl:if>
            </xsl:for-each>
          </xsl:element>
        </xsl:for-each>
        <xsl:for-each select="action">
          <xsl:variable name="pos" select="position()"/>
        <xsl:element name="monsterAction{$pos}">
          <xsl:value-of select="name" />
          <xsl:text> &#xa;</xsl:text>
          <xsl:for-each select="text">
              <xsl:value-of select="."/>
              <xsl:if test="position() != last()">
                 <!-- ADD SPACE DELIMITER AFTER EACH ITEM EXCEPT LAST -->
                 <!-- REPLACE WITH &#xa; FOR LINE BREAK ENTITY or \n -->
                 <xsl:text> &#xa;&#xa;</xsl:text>
              </xsl:if>
          </xsl:for-each>
        </xsl:element>
      </xsl:for-each>

      <xsl:for-each select="monsterLegendary">
        <xsl:variable name="pos" select="position()"/>
      <xsl:element name="monsterLegendary{$pos}">
        <xsl:value-of select="name" />
        <xsl:text> &#xa;</xsl:text>
        <xsl:for-each select="text">
            <xsl:value-of select="."/>

        </xsl:for-each>
      </xsl:element>
    </xsl:for-each>

    </xsl:copy>
  </xsl:template>

</xsl:stylesheet>
